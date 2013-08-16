<?php
namespace ez\lib;

/*********************************************************************************************************************\
 * LAST UPDATE
 * ============
 * March 22, 2007
 *
 *
 * AUTHOR
 * =============
 * Kwaku Otchere 
 * ospinto@hotmail.com
 * 
 * Thanks to Andrew Hewitt (rudebwoy@hotmail.com) for the idea and suggestion
 * 
 * All the credit goes to ColdFusion's brilliant cfdump tag
 * Hope the next version of PHP can implement this or have something similar
 * I love PHP, but var_dump BLOWS!!!
 *
 * FOR DOCUMENTATION AND MORE EXAMPLES: VISIT http://dbug.ospinto.com
 *
 *
 * PURPOSE
 * =============
 * Dumps/Displays the contents of a variable in a colored tabular format
 * Based on the idea, javascript and css code of Macromedia's ColdFusion cfdump tag
 * A much better presentation of a variable's contents than PHP's var_dump and print_r functions
 *
 *
 * USAGE
 * =============
 * new dBug ( variable [,forceType] );
 * example:
 * new dBug ( $myVariable );
 *
 * 
 * if the optional "forceType" string is given, the variable supplied to the 
 * function is forced to have that forceType type. 
 * example: new dBug( $myVariable , "array" );
 * will force $myVariable to be treated and dumped as an array type, 
 * even though it might originally have been a string type, etc.
 *
 * NOTE!
 * ==============
 * forceType is REQUIRED for dumping an xml string or xml file
 * new dBug ( $strXml, "xml" );
 * 
\*********************************************************************************************************************/

class dBug {
	
	private static $xmlDepth=array();
	private static $xmlCData;
	private static $xmlSData;
	private static $xmlDData;
	private static $xmlCount=0;
	private static $xmlAttrib;
	private static $xmlName;
	private static $arrType=array("array","object","resource","boolean","NULL");
	private static $bInitialized = false;
	private static $bCollapsed = false;
	private static $arrHistory = array();
	
	//constructor
	public static function dump($var,$forceType="",$bCollapsed=false) {
		//include js and css scripts
		if(!defined('BDBUGINIT')) {
			define("BDBUGINIT", TRUE);
			self::initJSandCSS();
		}
		$arrAccept=array("array","object","xml"); //array of variable types that can be "forced"
		self::$bCollapsed = $bCollapsed;
		if(in_array($forceType,$arrAccept))
			self::${"varIs".ucfirst($forceType)}($var);
		else
			self::checkType($var);
	}

	//get variable name
	public static function getVariableName() {
		$arrBacktrace = debug_backtrace();

		//possible 'included' functions
		$arrInclude = array("include","include_once","require","require_once");
		
		//check for any included/required files. if found, get array of the last included file (they contain the right line numbers)
		for($i=count($arrBacktrace)-1; $i>=0; $i--) {
			$arrCurrent = $arrBacktrace[$i];
			if(array_key_exists("function", $arrCurrent) && 
				(in_array($arrCurrent["function"], $arrInclude) || (0 != strcasecmp($arrCurrent["function"], "dbug"))))
				continue;

			$arrFile = $arrCurrent;
			
			break;
		}
		
		if(isset($arrFile)) {
			$arrLines = file($arrFile["file"]);
			$code = $arrLines[($arrFile["line"]-1)];
	
			//find call to dBug class
			preg_match('/\bnew dBug\s*\(\s*(.+)\s*\);/i', $code, $arrMatches);
			
			return is_array($arrMatches) && isset($arrMatches[1]) ? $arrMatches[1] : '';
		}
		return "";
	}
	
	//create the main table header
	public static function makeTableHeader($type,$header,$colspan=2) {
		if(!self::$bInitialized) {
			$header = self::getVariableName() . " (" . $header . ")";
			self::$bInitialized = true;
		}
		$str_i = (self::$bCollapsed) ? "style=\"font-style:italic\" " : ""; 
		
		echo "<table cellspacing=2 cellpadding=3 class=\"dBug_".$type."\">
				<tr>
					<td ".$str_i."class=\"dBug_".$type."Header\" colspan=".$colspan." onClick='dBug_toggleTable(this)'>".$header."</td>
				</tr>";
	}
	
	//create the table row header
	public static function makeTDHeader($type,$header) {
		$str_d = (self::$bCollapsed) ? " style=\"display:none\"" : "";
		echo "<tr".$str_d.">
				<td valign=\"top\" onClick='dBug_toggleRow(this)' class=\"dBug_".$type."Key\">".$header."</td>
				<td>";
	}
	
	//close table row
	public static function closeTDRow() {
		return "</td></tr>\n";
	}
	
	//error
	public static function  error($type) {
		$error="Error: Variable cannot be a";
		// this just checks if the type starts with a vowel or "x" and displays either "a" or "an"
		if(in_array(substr($type,0,1),array("a","e","i","o","u","x")))
			$error.="n";
		return ($error." ".$type." type");
	}

	//check variable type
	public static function checkType($var) {
		switch(gettype($var)) {
			case "resource":
				self::varIsResource($var);
				break;
			case "object":
				self::varIsObject($var);
				break;
			case "array":
				self::varIsArray($var);
				break;
			case "NULL":
				self::varIsNULL();
				break;
			case "boolean":
				self::varIsBoolean($var);
				break;
			default:
				$var=($var=="") ? "[empty string]" : $var;
				echo "<table cellspacing=0><tr>\n<td>".$var."</td>\n</tr>\n</table>\n";
				break;
		}
	}
	
	//if variable is a NULL type
	public static function varIsNULL() {
		echo "NULL";
	}
	
	//if variable is a boolean type
	public static function varIsBoolean($var) {
		$var=($var==1) ? "TRUE" : "FALSE";
		echo $var;
	}
			
	//if variable is an array type
	public static function varIsArray($var) {
		$var_ser = serialize($var);
		array_push(self::$arrHistory, $var_ser);
		
		self::makeTableHeader("array","array");
		if(is_array($var)) {
			foreach($var as $key=>$value) {
				self::makeTDHeader("array",$key);
				
				//check for recursion
				if(is_array($value)) {
					$var_ser = serialize($value);
					if(in_array($var_ser, self::$arrHistory, TRUE))
						$value = "*RECURSION*";
				}
				
				if(in_array(gettype($value),self::$arrType))
					self::checkType($value);
				else {
					$value=(trim($value)=="") ? "[empty string]" : $value;
					echo $value;
				}
				echo self::closeTDRow();
			}
		}
		else echo "<tr><td>".self::$error("array").self::closeTDRow();
		array_pop(self::$arrHistory);
		echo "</table>";
	}
	
	//if variable is an object type
	public static function varIsObject($var) {
		$var_ser = serialize($var);
		array_push(self::$arrHistory, $var_ser);
		self::makeTableHeader("object","object");
		
		if(is_object($var)) {
			$arrObjVars=get_object_vars($var);
			foreach($arrObjVars as $key=>$value) {

				$value=(!is_object($value) && !is_array($value) && trim($value)=="") ? "[empty string]" : $value;
				self::makeTDHeader("object",$key);
				
				//check for recursion
				if(is_object($value)||is_array($value)) {
					$var_ser = serialize($value);
					if(in_array($var_ser, self::$arrHistory, TRUE)) {
						$value = (is_object($value)) ? "*RECURSION* -> $".get_class($value) : "*RECURSION*";

					}
				}
				if(in_array(gettype($value),self::$arrType))
					self::checkType($value);
				else echo $value;
				echo self::closeTDRow();
			}
			$arrObjMethods=get_class_methods(get_class($var));
			foreach($arrObjMethods as $key=>$value) {
				self::makeTDHeader("object",$value);
				echo "[function]".self::closeTDRow();
			}
		}
		else echo "<tr><td>".self::$error("object").self::closeTDRow();
		array_pop(self::$arrHistory);
		echo "</table>";
	}

	//if variable is a resource type
	public static function varIsResource($var) {
		self::makeTableHeader("resourceC","resource",1);
		echo "<tr>\n<td>\n";
		switch(get_resource_type($var)) {
			case "fbsql result":
			case "mssql result":
			case "msql query":
			case "pgsql result":
			case "sybase-db result":
			case "sybase-ct result":
			case "mysql result":
				$db=current(explode(" ",get_resource_type($var)));
				self::$varIsDBResource($var,$db);
				break;
			case "gd":
				self::$varIsGDResource($var);
				break;
			case "xml":
				self::$varIsXmlResource($var);
				break;
			default:
				echo get_resource_type($var).self::closeTDRow();
				break;
		}
		echo self::closeTDRow()."</table>\n";
	}

	//if variable is a database resource type
	public static function varIsDBResource($var,$db="mysql") {
		if($db == "pgsql")
			$db = "pg";
		if($db == "sybase-db" || $db == "sybase-ct")
			$db = "sybase";
		$arrFields = array("name","type","flags");	
		$numrows=call_user_func($db."_num_rows",$var);
		$numfields=call_user_func($db."_num_fields",$var);
		self::makeTableHeader("resource",$db." result",$numfields+1);
		echo "<tr><td class=\"dBug_resourceKey\">&nbsp;</td>";
		for($i=0;$i<$numfields;$i++) {
			$field_header = "";
			for($j=0; $j<count($arrFields); $j++) {
				$db_func = $db."_field_".$arrFields[$j];
				if(function_exists($db_func)) {
					$fheader = call_user_func($db_func, $var, $i). " ";
					if($j==0)
						$field_name = $fheader;
					else
						$field_header .= $fheader;
				}
			}
			$field[$i]=call_user_func($db."_fetch_field",$var,$i);
			echo "<td class=\"dBug_resourceKey\" title=\"".$field_header."\">".$field_name."</td>";
		}
		echo "</tr>";
		for($i=0;$i<$numrows;$i++) {
			$row=call_user_func($db."_fetch_array",$var,constant(strtoupper($db)."_ASSOC"));
			echo "<tr>\n";
			echo "<td class=\"dBug_resourceKey\">".($i+1)."</td>"; 
			for($k=0;$k<$numfields;$k++) {
				$tempField=$field[$k]->name;
				$fieldrow=$row[($field[$k]->name)];
				$fieldrow=($fieldrow=="") ? "[empty string]" : $fieldrow;
				echo "<td>".$fieldrow."</td>\n";
			}
			echo "</tr>\n";
		}
		echo "</table>";
		if($numrows>0)
			call_user_func($db."_data_seek",$var,0);
	}
	
	//if variable is an image/gd resource type
	public static function varIsGDResource($var) {
		self::makeTableHeader("resource","gd",2);
		self::makeTDHeader("resource","Width");
		echo imagesx($var).self::closeTDRow();
		self::makeTDHeader("resource","Height");
		echo imagesy($var).self::closeTDRow();
		self::makeTDHeader("resource","Colors");
		echo imagecolorstotal($var).self::closeTDRow();
		echo "</table>";
	}
	
	//if variable is an xml type
	public static function varIsXml($var) {
		self::$varIsXmlResource($var);
	}
	
	//if variable is an xml resource type
	public static function varIsXmlResource($var) {
		$xml_parser=xml_parser_create();
		xml_parser_set_option($xml_parser,XML_OPTION_CASE_FOLDING,0); 
		xml_set_element_handler($xml_parser,array(&$this,"xmlStartElement"),array(&$this,"xmlEndElement")); 
		xml_set_character_data_handler($xml_parser,array(&$this,"xmlCharacterData"));
		xml_set_default_handler($xml_parser,array(&$this,"xmlDefaultHandler")); 
		
		self::makeTableHeader("xml","xml document",2);
		self::makeTDHeader("xml","xmlRoot");
		
		//attempt to open xml file
		$bFile=(!($fp=@fopen($var,"r"))) ? false : true;
		
		//read xml file
		if($bFile) {
			while($data=str_replace("\n","",fread($fp,4096)))
				self::$xmlParse($xml_parser,$data,feof($fp));
		}
		//if xml is not a file, attempt to read it as a string
		else {
			if(!is_string($var)) {
				echo self::$error("xml").self::closeTDRow()."</table>\n";
				return;
			}
			$data=$var;
			self::$xmlParse($xml_parser,$data,1);
		}
		
		echo self::closeTDRow()."</table>\n";
		
	}
	
	//parse xml
	public static function xmlParse($xml_parser,$data,$bFinal) {
		if (!xml_parse($xml_parser,$data,$bFinal)) { 
				   die(sprintf("XML error: %s at line %d\n", 
							   xml_error_string(xml_get_error_code($xml_parser)), 
							   xml_get_current_line_number($xml_parser)));
		}
	}
	
	//xml: inititiated when a start tag is encountered
	public static function xmlStartElement($parser,$name,$attribs) {
		self::$xmlAttrib[self::$xmlCount]=$attribs;
		self::$xmlName[self::$xmlCount]=$name;
		self::$xmlSData[self::$xmlCount]='self::makeTableHeader("xml","xml element",2);';
		self::$xmlSData[self::$xmlCount].='self::makeTDHeader("xml","xmlName");';
		self::$xmlSData[self::$xmlCount].='echo "<strong>'.self::$xmlName[self::$xmlCount].'</strong>".self::closeTDRow();';
		self::$xmlSData[self::$xmlCount].='self::makeTDHeader("xml","xmlAttributes");';
		if(count($attribs)>0)
			self::$xmlSData[self::$xmlCount].='self::$varIsArray(self::$xmlAttrib['.self::$xmlCount.']);';
		else
			self::$xmlSData[self::$xmlCount].='echo "&nbsp;";';
		self::$xmlSData[self::$xmlCount].='echo self::closeTDRow();';
		self::$xmlCount++;
	} 
	
	//xml: initiated when an end tag is encountered
	public static function xmlEndElement($parser,$name) {
		for($i=0;$i<self::$xmlCount;$i++) {
			eval(self::$xmlSData[$i]);
			self::makeTDHeader("xml","xmlText");
			echo (!empty(self::$xmlCData[$i])) ? self::$xmlCData[$i] : "&nbsp;";
			echo self::closeTDRow();
			self::makeTDHeader("xml","xmlComment");
			echo (!empty(self::$xmlDData[$i])) ? self::$xmlDData[$i] : "&nbsp;";
			echo self::closeTDRow();
			self::makeTDHeader("xml","xmlChildren");
			unset(self::$xmlCData[$i],self::$xmlDData[$i]);
		}
		echo self::closeTDRow();
		echo "</table>";
		self::$xmlCount=0;
	} 
	
	//xml: initiated when text between tags is encountered
	public static function xmlCharacterData($parser,$data) {
		$count=self::$xmlCount-1;
		if(!empty(self::$xmlCData[$count]))
			self::$xmlCData[$count].=$data;
		else
			self::$xmlCData[$count]=$data;
	} 
	
	//xml: initiated when a comment or other miscellaneous texts is encountered
	public static function xmlDefaultHandler($parser,$data) {
		//strip '<!--' and '-->' off comments
		$data=str_replace(array("&lt;!--","--&gt;"),"",htmlspecialchars($data));
		$count=self::$xmlCount-1;
		if(!empty(self::$xmlDData[$count]))
			self::$xmlDData[$count].=$data;
		else
			self::$xmlDData[$count]=$data;
	}

	public static function initJSandCSS() {
		echo <<<SCRIPTS
			<script language="JavaScript">
			/* code modified from ColdFusion's cfdump code */
				function dBug_toggleRow(source) {
					var target = (document.all) ? source.parentElement.cells[1] : source.parentNode.lastChild;
					dBug_toggleTarget(target,dBug_toggleSource(source));
				}
				
				function dBug_toggleSource(source) {
					if (source.style.fontStyle=='italic') {
						source.style.fontStyle='normal';
						source.title='click to collapse';
						return 'open';
					} else {
						source.style.fontStyle='italic';
						source.title='click to expand';
						return 'closed';
					}
				}
			
				function dBug_toggleTarget(target,switchToState) {
					target.style.display = (switchToState=='open') ? '' : 'none';
				}
			
				function dBug_toggleTable(source) {
					var switchToState=dBug_toggleSource(source);
					if(document.all) {
						var table=source.parentElement.parentElement;
						for(var i=1;i<table.rows.length;i++) {
							target=table.rows[i];
							dBug_toggleTarget(target,switchToState);
						}
					}
					else {
						var table=source.parentNode.parentNode;
						for (var i=1;i<table.childNodes.length;i++) {
							target=table.childNodes[i];
							if(target.style) {
								dBug_toggleTarget(target,switchToState);
							}
						}
					}
				}
			</script>
			
			<style type="text/css">
				table.dBug_array,table.dBug_object,table.dBug_resource,table.dBug_resourceC,table.dBug_xml {
					font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; font-size:12px;
				}
				
				.dBug_arrayHeader,
				.dBug_objectHeader,
				.dBug_resourceHeader,
				.dBug_resourceCHeader,
				.dBug_xmlHeader 
					{ font-weight:bold; color:#FFFFFF; cursor:pointer; }
				
				.dBug_arrayKey,
				.dBug_objectKey,
				.dBug_xmlKey 
					{ cursor:pointer; }
					
				/* array */
				table.dBug_array { background-color:#006600; }
				table.dBug_array td { background-color:#FFFFFF; }
				table.dBug_array td.dBug_arrayHeader { background-color:#009900; }
				table.dBug_array td.dBug_arrayKey { background-color:#CCFFCC; }
				
				/* object */
				table.dBug_object { background-color:#0000CC; }
				table.dBug_object td { background-color:#FFFFFF; }
				table.dBug_object td.dBug_objectHeader { background-color:#4444CC; }
				table.dBug_object td.dBug_objectKey { background-color:#CCDDFF; }
				
				/* resource */
				table.dBug_resourceC { background-color:#884488; }
				table.dBug_resourceC td { background-color:#FFFFFF; }
				table.dBug_resourceC td.dBug_resourceCHeader { background-color:#AA66AA; }
				table.dBug_resourceC td.dBug_resourceCKey { background-color:#FFDDFF; }
				
				/* resource */
				table.dBug_resource { background-color:#884488; }
				table.dBug_resource td { background-color:#FFFFFF; }
				table.dBug_resource td.dBug_resourceHeader { background-color:#AA66AA; }
				table.dBug_resource td.dBug_resourceKey { background-color:#FFDDFF; }
				
				/* xml */
				table.dBug_xml { background-color:#888888; }
				table.dBug_xml td { background-color:#FFFFFF; }
				table.dBug_xml td.dBug_xmlHeader { background-color:#AAAAAA; }
				table.dBug_xml td.dBug_xmlKey { background-color:#DDDDDD; }
			</style>
SCRIPTS;
	}

}