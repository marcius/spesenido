<?php
/**
 * CJuiJqGrid class file.
 *
 * @author Marco Curatitoli <makro76@gmail.com>
 */

Yii::import('zii.widgets.jui.CJuiWidget');

/**
 * CJuiJqGrid displays a jqGrid widget.
 *
 * CJuiJqGrid encapsulates the {@link http://www.trirand.com/blog/}
 * plugin.
 *
 * To use this widget, you may insert the following code in a view:
 * <pre>
 * $this->widget('ext.jqgrid.CJuiJqGrid', array(
 * 		'modelClass'=>'Model', // used for columns label
 * 		'htmlOptions'=>array(
 * 			'id'=>'grid',
 * 		),
 * 		'navbar'=>true,
 * 		'options'=>array(
 * 			'height'=>400,
 * 			'autowidth'=>true,
 * 			'datatype'=>'json',
 * 			'url'=>Yii::app()->createUrl('index'), // ajax request for data
 * 			'colNames'=>array('id','column1','column2'), // model attributes
 * 		//	'colModel'=>array( // optional, this is generated automatically from colNames if 'modelClass' is defined
 *		//		array('index'=>'id','name'=>'id','hidden'=>true)
 *		//		array('index'=>'column1','name'=>'column1')
 *		//		array('index'=>'column2','name'=>'column2')
 * 		//	),
 * 			'rowNum'=>20,
 * 			'rowList'=>array(20,50,100),
 * 			'sortname'=>'column',
 * 			'sortorder'=>"asc",
 * 			'caption'=>"Grid title",
 * 		)
 * 	)
 * );
 * </pre>
 *
 * Example for controller:
 * if (Yii::app()->request->isAjaxRequest) {
 * 		$criteria=new CDbCriteria;
 * 		// $criteria->compare(); // here I can filter data
 *
 * 		$page = $_GET['page'];
 * 		$limit = $_GET['rows'];
 * 		$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
 * 		$sord = $_GET['sord']; // get the direction
 *
 * 		$dataProvider = new CActiveDataProvider('Model', array(
 * 			'criteria'=>$criteria,
 * 			'pagination'=>array(
 * 				'currentPage'=>$page-1, // jqGrid index isn't zero-based
 * 				'pageSize'=>$limit,
 * 			),
 * 			'sort'=>array(
 * 				'defaultOrder'=>"$sidx $sord",
 * 			)
 * 		));
 *
 * 		$count = $dataProvider->totalItemCount;
 * 		$total_pages=($count) ? $total_pages = ceil($count/$limit) : $total_pages = 0;
 *
 *		// prepare json data for jqGrid
 *		$response->page = $page;
 *		$response->total = $total_pages;
 *		$response->records = $count;
 *		$data=$dataProvider->getData();
 *		foreach($data as $row) {
 *			$response->rows[]=array(
 * 				'id'=>$row->id,
 * 				'cell'=>array(
 * 					$row->column1,
 * 					$row->column2,
 *					//...
 * 				)
 * 			);
 * 		}
 * 		echo CJavaScript::jsonEncode($response);
 * }
 *
 *
 * By configuring the {@link options} property, you may specify the options
 * that need to be passed to the jqGrid plugin. Please refer to
 * the {@link http://www.trirand.com/jqgridwiki/doku.php} documentation
 * for possible options (name-value pairs).
 *
 * @author Marco Curatitoli <makro76@gmail.com>
 */
class CJuiJqGrid extends CJuiWidget
{
	/**
	 * @var string the name of the container element that contains all panels. Defaults to 'table'.
	 */
	public $tagName='table';

	/**
	 * @var string the root URL that contains all jqGrid JavaScript files.
	 * If this property is not set (default), Yii will publish the jqGrid package included in the extension
	 * that to infer the root script URL. You should set this property if you intend to use
	 * a jqGrid package whose version is different from the one included in the extension.
	 * Note that under this URL, there must be a file whose name is specified by {@link gridScriptFile}.
	 * Do not append any slash character to the URL.
	 */
	public $gridScriptUrl;
	/**
	 * @var mixed the main jqGrid JavaScript file. Defaults to 'jquery.jqGrid.min.js'.
	 * Note the file must exist under the URL specified by {@link gridScriptUrl}.
	 * If you need to include multiple script files (e.g. during development, you want to include individual
	 * plugin script files rather than the minized jqGrid script file), you may set this property
	 * as an array of the script file names.
	 * This property can also be set as false, which means the widget will not include any script file,
	 * and it is your responsibility to explicitly include it somewhere else.
	 */
	public $gridScriptFile='jquery.jqGrid.min.js';
	/**
	 * @var string the root URL that contains all jqGrid CSS files.
	 * If this property is not set (default), Yii will publish the jqGrid CSS included in the extension
	 * that to infer the root script URL. You should set this property if you intend to use
	 * a jqGrid CSS whose version is different from the one included in the extension.
	 * Note that under this URL, there must be a file whose name is specified by {@link gridCssFile}.
	 * Do not append any slash character to the URL.
	 */
	public $gridCssUrl;
	/**
	 * @var mixed the theme CSS file name. Defaults to 'ui.jqgrid.css'.
	 * If you need to include multiple theme CSS files (e.g. during development, you want to include individual
	 * plugin CSS files), you may set this property as an array of the CSS file names.
	 * This property can also be set as false, which means the widget will not include any theme CSS file,
	 * and it is your responsibility to explicitly include it somewhere else.
	 */
	public $gridCssFile='ui.jqgrid.css';
	/**
	 * @var string the locale ID (e.g. 'fr', 'de') for the language to be used by the date picker.
	 * If this property is not set, I18N will not be involved. That is, the date picker will show in English.
	 */
	public $language='it';
	/**
	 * @var string the primary ActiveRecord class name. The {@link getData()} method
	 * will return a list of objects of this class.
	 */
	public $modelClass;
	/**
	 * @var boolean shows the navigation (pager) bar
	 */
	protected $navbar = true;
	/**
	 * @var array the navigation bar options. Options are all boolean and are:
	 * edit shows edit button
	 * add shows add button
	 * del shows del dialog
	 * search shows search dialog
	 * refresh shows refresh button
	 */
	protected $navbarOptions=array();

	/**
	 * @var array default navigation bar options. It will be merged with  {@link navbarOptions()}
	 */
	private $defaultNavbarOptions = array('edit'=>false, 'add'=>false, 'del'=>false, 'search'=>false, 'refresh'=>false);

	private $attributes=array();

	/**
	 * Initializes the widget.
	 * This method will publish jqGrid assets if necessary.
	 * It will also register theme CSS file.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		$this->resolveGridPackagePath();
		$this->registerGridScripts();
	}

	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$id=$this->getId();

		$this->prepareColumns();

		if ($this->navbar)
			$this->options['pager'] = "{$id}_pager";
		$options=empty($this->options) ? '' : CJavaScript::encode($this->options);

		$tableOptions = array_merge($this->htmlOptions,array('id'=>"{$id}_grid"));

		$pagerOptions = array('id'=>"{$id}_pager");

		if ($this->navbar)
		{
			$navOptions=CJavaScript::encode(array_merge($this->defaultNavbarOptions,$this->navbarOptions));
			$nav=".navGrid('#{$id}_pager', {$navOptions})";
		}

		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'."{$id}_grid","jQuery('#{$id}_grid').jqGrid($options){$nav};");

		echo CHtml::tag($this->tagName,$tableOptions,'',true)."\n";
		if ($this->navbar)
			echo CHtml::tag('div', $pagerOptions, '', true);
	}

	/**
	 * Prepares grid columns using colModel if specified
	 */
	private function prepareColumns()
	{
		$colModels = array_merge($this->options['colModel'],array());
		foreach ($this->options['colNames'] as $i=>$colName)
		{
			$this->options['colNames'][$i]=$this->resolveLabel($colName);
			$colTemplate=array('index'=>$colName,'name'=>$colName);
			if(!is_array($colModels[$i])) $colModels[$i] = array();
			$this->options['colModel'][$i]=array_merge($colTemplate,$colModels[$i]);
		}

	}

	/**
	 * Determine the jqGrid package installation path.
	 * This method will identify the JavaScript root URL.
	 * If they are not explicitly specified, it will publish the included jqGrid package
	 * and use that to resolve the needed paths.
	 */
	protected function resolveGridPackagePath()
	{
		if($this->gridScriptUrl===null || $this->themeUrl===null)
		{
			$basePath= dirname(__FILE__)."/vendors";
			$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
			if($this->gridScriptUrl===null)
				$this->gridScriptUrl=$baseUrl.'/js';
			if($this->gridCssUrl===null)
				$this->gridCssUrl=$baseUrl.'/css';
		}
	}

	/**
	 * Registers the core script files.
	 * This method registers jquery and JUI JavaScript files and the theme CSS file.
	 */
	protected function registerGridScripts()
	{
		if (isset($this->language)){
			$this->registerGridScriptFile("i18n/grid.locale-{$this->language}.js");
		}

		$cs=Yii::app()->getClientScript();
		if(is_string($this->gridCssFile))
			$cs->registerCssFile($this->gridCssUrl.'/'.$this->gridCssFile);
		if(is_string($this->gridScriptFile))
			$this->registerGridScriptFile($this->gridScriptFile);
		else if(is_array($this->gridScriptFile))
		{
			foreach($this->gridScriptFile as $scriptFile)
				$this->registerGridScriptFile($scriptFile);
		}
	}

	/**
	 * Registers a JavaScript file under {@link scriptUrl}.
	 * Note that by default, the script file will be rendered at the end of a page to improve page loading speed.
	 * @param string JavaScript file name
	 * @param integer the position of the JavaScript file. Valid values include the following:
	 * <ul>
	 * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
	 * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
	 * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
	 * </ul>
	 */
	protected function registerGridScriptFile($fileName,$position=CClientScript::POS_END)
	{
		Yii::app()->getClientScript()->registerScriptFile($this->gridScriptUrl.'/'.$fileName,$position);
	}

	public function resolveLabel($attribute)
	{
		$definition=$this->resolveAttribute($attribute);
		if(is_array($definition))
		{
			if(isset($definition['label']))
				return $definition['label'];
		}
		else if(is_string($definition))
			$attribute=$definition;
		if($this->modelClass!==null)
			return CActiveRecord::model($this->modelClass)->getAttributeLabel($attribute);
		else
			return $attribute;
	}

	public function resolveAttribute($attribute)
	{
		if($this->attributes!==array())
			$attributes=$this->attributes;
		else if($this->modelClass!==null)
			$attributes=CActiveRecord::model($this->modelClass)->attributeNames();
		else
			return false;
		foreach($attributes as $name=>$definition)
		{
			if(is_string($name))
			{
				if($name===$attribute)
					return $definition;
			}
			else if($definition===$attribute)
				return $attribute;
		}
		return false;
	}

	/**
    * Setter
    *
    * @param boolean $value navbar
    */
   public function setNavbar($value)
   {
      if (!is_bool($value))
         throw new CException(Yii::t('CJuiJqGrid', 'navbar must be boolean'));
      $this->navbar = $value;
   }

   /**
    * Getter
    *
    * @return boolean
    */
   public function getNavbar()
   {
      return $this->navbar;
   }
}