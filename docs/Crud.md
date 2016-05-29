## Table of contents

- [\Vein\Core\Crud\Grid (abstract)](#class-veincorecrudgrid-abstract)
- [\Vein\Core\Crud\Helper (abstract)](#class-veincorecrudhelper-abstract)
- [\Vein\Core\Crud\Container\Mysql (abstract)](#class-veincorecrudcontainermysql-abstract)
- [\Vein\Core\Crud\Container\Form\Exception](#class-veincorecrudcontainerformexception)
- [\Vein\Core\Crud\Container\Grid\Exception](#class-veincorecrudcontainergridexception)
- [\Vein\Core\Crud\Container\Grid\Mysql\Elasticsearch](#class-veincorecrudcontainergridmysqlelasticsearch)
- [\Vein\Core\Crud\Container\Grid\Mysql\Exception](#class-veincorecrudcontainergridmysqlexception)
- [\Vein\Core\Crud\Form\Exception](#class-veincorecrudformexception)
- [\Vein\Core\Crud\Form\Extjs (abstract)](#class-veincorecrudformextjs-abstract)
- [\Vein\Core\Crud\Form\Field\ManyToMany](#class-veincorecrudformfieldmanytomany)
- [\Vein\Core\Crud\Grid\Exception](#class-veincorecrudgridexception)
- [\Vein\Core\Crud\Grid\Extjs (abstract)](#class-veincorecrudgridextjs-abstract)
- [\Vein\Core\Crud\Grid\Column (abstract)](#class-veincorecrudgridcolumn-abstract)
- [\Vein\Core\Crud\Grid\Column\Compound](#class-veincorecrudgridcolumncompound)
- [\Vein\Core\Crud\Grid\Column\Action](#class-veincorecrudgridcolumnaction)
- [\Vein\Core\Crud\Grid\Column\Custom](#class-veincorecrudgridcolumncustom)
- [\Vein\Core\Crud\Helper\Filter\Standart](#class-veincorecrudhelperfilterstandart)
- [\Vein\Core\Crud\Helper\Filter\Extjs](#class-veincorecrudhelperfilterextjs)
- [\Vein\Core\Crud\Helper\Filter\Extjs\Buttons](#class-veincorecrudhelperfilterextjsbuttons)
- [\Vein\Core\Crud\Helper\Filter\Extjs\Functions](#class-veincorecrudhelperfilterextjsfunctions)
- [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)
- [\Vein\Core\Crud\Helper\Filter\Extjs\Components](#class-veincorecrudhelperfilterextjscomponents)
- [\Vein\Core\Crud\Helper\Filter\Extjs\Fields](#class-veincorecrudhelperfilterextjsfields)
- [\Vein\Core\Crud\Helper\Filter\Field\Standart](#class-veincorecrudhelperfilterfieldstandart)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Standart](#class-veincorecrudhelperfilterfieldextjsstandart)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Join](#class-veincorecrudhelperfilterfieldextjsjoin)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Name](#class-veincorecrudhelperfilterfieldextjsname)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\ArrayToSelect](#class-veincorecrudhelperfilterfieldextjsarraytoselect)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Combobox](#class-veincorecrudhelperfilterfieldextjscombobox)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Mail](#class-veincorecrudhelperfilterfieldextjsmail)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Checkbox](#class-veincorecrudhelperfilterfieldextjscheckbox)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Numeric](#class-veincorecrudhelperfilterfieldextjsnumeric)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Primary](#class-veincorecrudhelperfilterfieldextjsprimary)
- [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Date](#class-veincorecrudhelperfilterfieldextjsdate)
- [\Vein\Core\Crud\Helper\Filter\Field\Standart\Description](#class-veincorecrudhelperfilterfieldstandartdescription)
- [\Vein\Core\Crud\Helper\Filter\Field\Standart\Message](#class-veincorecrudhelperfilterfieldstandartmessage)
- [\Vein\Core\Crud\Helper\Filter\Field\Standart\Element](#class-veincorecrudhelperfilterfieldstandartelement)
- [\Vein\Core\Crud\Helper\Filter\Field\Standart\Label](#class-veincorecrudhelperfilterfieldstandartlabel)
- [\Vein\Core\Crud\Helper\Form\Standart](#class-veincorecrudhelperformstandart)
- [\Vein\Core\Crud\Helper\Form\Extjs](#class-veincorecrudhelperformextjs)
- [\Vein\Core\Crud\Helper\Form\Extjs\Buttons](#class-veincorecrudhelperformextjsbuttons)
- [\Vein\Core\Crud\Helper\Form\Extjs\Model](#class-veincorecrudhelperformextjsmodel)
- [\Vein\Core\Crud\Helper\Form\Extjs\Functions](#class-veincorecrudhelperformextjsfunctions)
- [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)
- [\Vein\Core\Crud\Helper\Form\Extjs\Components](#class-veincorecrudhelperformextjscomponents)
- [\Vein\Core\Crud\Helper\Form\Extjs\Fields](#class-veincorecrudhelperformextjsfields)
- [\Vein\Core\Crud\Helper\Form\Extjs\Store](#class-veincorecrudhelperformextjsstore)
- [\Vein\Core\Crud\Helper\Form\Field\Standart](#class-veincorecrudhelperformfieldstandart)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Name](#class-veincorecrudhelperformfieldextjsname)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\ManyToOne](#class-veincorecrudhelperformfieldextjsmanytoone)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\ArrayToSelect](#class-veincorecrudhelperformfieldextjsarraytoselect)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Password](#class-veincorecrudhelperformfieldextjspassword)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Combobox](#class-veincorecrudhelperformfieldextjscombobox)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Mail](#class-veincorecrudhelperformfieldextjsmail)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Checkbox](#class-veincorecrudhelperformfieldextjscheckbox)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\File](#class-veincorecrudhelperformfieldextjsfile)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Numeric](#class-veincorecrudhelperformfieldextjsnumeric)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\ManyToMany](#class-veincorecrudhelperformfieldextjsmanytomany)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\TextArea](#class-veincorecrudhelperformfieldextjstextarea)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Image](#class-veincorecrudhelperformfieldextjsimage)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Primary](#class-veincorecrudhelperformfieldextjsprimary)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\HtmlEditor](#class-veincorecrudhelperformfieldextjshtmleditor)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Text](#class-veincorecrudhelperformfieldextjstext)
- [\Vein\Core\Crud\Helper\Form\Field\Extjs\Date](#class-veincorecrudhelperformfieldextjsdate)
- [\Vein\Core\Crud\Helper\Form\Field\Standart\Description](#class-veincorecrudhelperformfieldstandartdescription)
- [\Vein\Core\Crud\Helper\Form\Field\Standart\Message](#class-veincorecrudhelperformfieldstandartmessage)
- [\Vein\Core\Crud\Helper\Form\Field\Standart\Element](#class-veincorecrudhelperformfieldstandartelement)
- [\Vein\Core\Crud\Helper\Form\Field\Standart\Label](#class-veincorecrudhelperformfieldstandartlabel)
- [\Vein\Core\Crud\Helper\Grid\Standart](#class-veincorecrudhelpergridstandart)
- [\Vein\Core\Crud\Helper\Grid\Filter](#class-veincorecrudhelpergridfilter)
- [\Vein\Core\Crud\Helper\Grid\Extjs](#class-veincorecrudhelpergridextjs)
- [\Vein\Core\Crud\Helper\Grid\Dojo](#class-veincorecrudhelpergriddojo)
- [\Vein\Core\Crud\Helper\Grid\Jade](#class-veincorecrudhelpergridjade)
- [\Vein\Core\Crud\Helper\Grid\Dojo\Div](#class-veincorecrudhelpergriddojodiv)
- [\Vein\Core\Crud\Helper\Grid\Dojo\Layout](#class-veincorecrudhelpergriddojolayout)
- [\Vein\Core\Crud\Helper\Grid\Dojo\Datastore](#class-veincorecrudhelpergriddojodatastore)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Model](#class-veincorecrudhelpergridextjsmodel)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Window](#class-veincorecrudhelpergridextjswindow)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Columns](#class-veincorecrudhelpergridextjscolumns)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Functions](#class-veincorecrudhelpergridextjsfunctions)
- [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Filter](#class-veincorecrudhelpergridextjsfilter)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Paginator](#class-veincorecrudhelpergridextjspaginator)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Components](#class-veincorecrudhelpergridextjscomponents)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Controller](#class-veincorecrudhelpergridextjscontroller)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Store](#class-veincorecrudhelpergridextjsstore)
- [\Vein\Core\Crud\Helper\Grid\Extjs\Store\Local](#class-veincorecrudhelpergridextjsstorelocal)
- [\Vein\Core\Crud\Helper\Grid\Jade\Columns](#class-veincorecrudhelpergridjadecolumns)
- [\Vein\Core\Crud\Helper\Grid\Jade\Datastore](#class-veincorecrudhelpergridjadedatastore)
- [\Vein\Core\Crud\Helper\Grid\Jade\Paginator](#class-veincorecrudhelpergridjadepaginator)
- [\Vein\Core\Crud\Helper\Grid\Standart\Columns](#class-veincorecrudhelpergridstandartcolumns)
- [\Vein\Core\Crud\Helper\Grid\Standart\Datastore](#class-veincorecrudhelpergridstandartdatastore)
- [\Vein\Core\Crud\Helper\Grid\Standart\Paginator](#class-veincorecrudhelpergridstandartpaginator)
- [\Vein\Core\Crud\Tools\Multiselect](#class-veincorecrudtoolsmultiselect)

<hr /> 
### Class: \Vein\Core\Crud\Grid (abstract)

> Class for manage datas.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$params=array()</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>, <em>array/mixed/array</em> <strong>$options=array()</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>__get(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Return grid column</em> |
| public | <strong>__invoke(</strong><em>array</em> <strong>$data=null</strong>)</strong> : <em>void</em><br /><em>array_pop</em> |
| public | <strong>_normalizeHelper(</strong><em>string</em> <strong>$helper</strong>)</strong> : <em>string</em><br /><em>Normalize helper name</em> |
| public | <strong>addAdditional(</strong><em>string</em> <strong>$type</strong>, <em>string</em> <strong>$module</strong>, <em>string</em> <strong>$key</strong>, <em>string</em> <strong>$param</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Add grid additional</em> |
| public | <strong>addAttribs(</strong><em>array</em> <strong>$attribs</strong>)</strong> : <em>\Vein\Core\Tools\Traits\DIaware,
		\Vein\Core\Tools\Traits\EventsAware,
		\Vein\Core\Tools\Traits\Resource,
		\Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Set element attributes</em> |
| public | <strong>addAutoloadMethodPrefixException(</strong><em>string</em> <strong>$prefix</strong>)</strong> : <em>\Vein\Core\Tools\Traits\Resource</em><br /><em>Add prefix exception.</em> |
| public | <strong>addHelper(</strong><em>string</em> <strong>$helper</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Renderer</em><br /><em>Add helper</em> |
| public | <strong>addHelpers(</strong><em>array</em> <strong>$helpers</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Renderer</em><br /><em>Add helpers</em> |
| public | <strong>bulkUpdate(</strong><em>array/string</em> <strong>$ids</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>bool/array</em><br /><em>Update column in rows by array of primary key values.</em> |
| public | <strong>clearAttribs()</strong> : <em>\Vein\Core\Tools\Traits\DIaware,
		\Vein\Core\Tools\Traits\EventsAware,
		\Vein\Core\Tools\Traits\Resource,
		\Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Clear element attributes</em> |
| public | <strong>clearData()</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Clear grid data</em> |
| public | <strong>clearHelpers()</strong> : <em>\Vein\Core\Crud\Tools\Renderer</em><br /><em>Clear all helpers</em> |
| public | <strong>count()</strong> : <em>integer</em><br /><em>Count elements of an object</em> |
| public | <strong>current()</strong> : <em>mixed</em><br /><em>Return the current element</em> |
| public | <strong>deleteAction(</strong><em>array/string</em> <strong>$ids</strong>)</strong> : <em>bool/array</em><br /><em>Delete rows from grid table by array of primary key values.</em> |
| public | <strong>getAction()</strong> : <em>string</em><br /><em>Get grid action</em> |
| public | <strong>getAdditionals()</strong> : <em>array</em><br /><em>Return grid additionals</em> |
| public | <strong>getAttrib(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return element attribute</em> |
| public | <strong>getAttribs()</strong> : <em>array</em><br /><em>Return element attributes</em> |
| public | <strong>getAutoloadMethodPrefix()</strong> : <em>string</em><br /><em>Get $_autoloadMethodPrefix.</em> |
| public | <strong>getAutoloadMethodPrefixException()</strong> : <em>string</em><br /><em>Get $_autoloadMethodPrefixException</em> |
| public | <strong>getClassResourceNames()</strong> : <em>array</em><br /><em>Get class resource names</em> |
| public | <strong>getClassResources()</strong> : <em>array</em><br /><em>Get class resources (as resource/method pairs) Uses get_class_methods() by default, reflection on prior to 5.2.6, as a bug prevents the usage of get_class_methods() there.</em> |
| public | <strong>getColumnByName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Return column by name</em> |
| public | <strong>getColumnData()</strong> : <em>array</em><br /><em>Return data with column value</em> |
| public | <strong>getColumns()</strong> : <em>array</em><br /><em>Return grid columns</em> |
| public | <strong>getColumnsTitle()</strong> : <em>array</em><br /><em>Return grid columns titles.</em> |
| public | <strong>getConditions()</strong> : <em>array/string</em><br /><em>Return grid container conditions</em> |
| public | <strong>getContainer()</strong> : <em>\Vein\Core\Crud\Container\Grid\Adapter</em><br /><em>Return container adapter</em> |
| public | <strong>getCount()</strong> : <em>integer</em><br /><em>Return count data rows</em> |
| public | <strong>getCountCurrentPage()</strong> : <em>integer</em><br /><em>Return count row on current page</em> |
| public | <strong>getCurrentPage()</strong> : <em>integer</em><br /><em>Return count row on current page</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Return grid fetching data</em> |
| public | <strong>getDataWithRenderValues()</strong> : <em>array</em><br /><em>Return data with rendered values.</em> |
| public | <strong>getDecorator()</strong> : <em>\Vein\Core\Crud\Decorator</em><br /><em>Instantiate a decorator based on class name</em> |
| public | <strong>getDefaultParam(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return default param by name</em> |
| public | <strong>getDi()</strong> : <em>\Phalcon\DiInterface</em><br /><em>Returns the internal dependency injector</em> |
| public | <strong>getEventsManager()</strong> : <em>\Phalcon\Events\ManagerInterface</em><br /><em>Returns the internal event manager</em> |
| public | <strong>getExtraLimit()</strong> : <em>integer</em><br /><em>Return limit that use for store query like base limit</em> |
| public | <strong>getFilter()</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em><br /><em>Return filter</em> |
| public | <strong>getFilterParam(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string/array/null</em><br /><em>Return filter param by name</em> |
| public | <strong>getFilterParams()</strong> : <em>array</em><br /><em>Return filter params</em> |
| public | <strong>getForm()</strong> : <em>\Vein\Core\Crud\Form</em><br /><em>Return form</em> |
| public | <strong>getHelpers()</strong> : <em>array</em><br /><em>Return decorator helpers</em> |
| public | <strong>getId()</strong> : <em>string</em><br /><em>Get id param</em> |
| public | <strong>getJoins()</strong> : <em>array/string</em><br /><em>Return grid container joins rules</em> |
| public | <strong>getLimit()</strong> : <em>integer</em><br /><em>Get limit param</em> |
| public | <strong>getLimitParamName()</strong> : <em>string</em><br /><em>Return sort direction param name</em> |
| public | <strong>getModel()</strong> : <em>\Vein\Core\Mvc\Model</em><br /><em>Return container model</em> |
| public | <strong>getModelAdapter()</strong> : <em>\Vein\Core\Mvc\Model</em><br /><em>Return container model adapter</em> |
| public | <strong>getPage()</strong> : <em>integer</em><br /><em>Get page param</em> |
| public | <strong>getPageParamName()</strong> : <em>string</em><br /><em>Return sort direction param name</em> |
| public | <strong>getPages()</strong> : <em>integer</em><br /><em>Return count row on current page</em> |
| public | <strong>getPaginateParams()</strong> : <em>array</em><br /><em>Return paginate params</em> |
| public | <strong>getParams()</strong> : <em>array</em><br /><em>Return grid params</em> |
| public | <strong>getPrimaryColumn()</strong> : <em>array</em><br /><em>Return if exist primary grid column</em> |
| public | <strong>getSortDirection()</strong> : <em>string</em><br /><em>Get direction param</em> |
| public | <strong>getSortDirectionParamName()</strong> : <em>string</em><br /><em>Return sort direction param name</em> |
| public | <strong>getSortKey()</strong> : <em>string</em><br /><em>Get sort param</em> |
| public | <strong>getSortParamName()</strong> : <em>string</em><br /><em>Return sort param name</em> |
| public | <strong>getSortParams(</strong><em>bool</em> <strong>$withFilterParams=true</strong>)</strong> : <em>array</em><br /><em>Return current sort params</em> |
| public | <strong>getStaticCount()</strong> : <em>integer</em><br /><em>Set static grid items count</em> |
| public | <strong>getTitle()</strong> : <em>string</em><br /><em>Get grid title</em> |
| public | <strong>init()</strong> : <em>void</em><br /><em>Initialize grid (used by extending classes)</em> |
| public | <strong>isCountQuery()</strong> : <em>bool</em><br /><em>is execute count query</em> |
| public | <strong>isEditable()</strong> : <em>boolean</em><br /><em>Is grid data can be edit</em> |
| public | <strong>isException(</strong><em>string</em> <strong>$method</strong>)</strong> : <em>bool</em><br /><em>Check is method name is exception</em> |
| public | <strong>key()</strong> : <em>integer</em><br /><em>Return the key of the current element</em> |
| public | <strong>next()</strong> : <em>void</em><br /><em>Move forward to next element</em> |
| public | <strong>offsetExists(</strong><em>integer</em> <strong>$offset</strong>)</strong> : <em>boolean</em><br /><em>Whether a offset exists</em> |
| public | <strong>offsetGet(</strong><em>integer</em> <strong>$offset</strong>)</strong> : <em>mixed</em><br /><em>Offset to retrieve</em> |
| public | <strong>offsetSet(</strong><em>integer</em> <strong>$offset</strong>, <em>string</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Offset to set</em> |
| public | <strong>offsetUnset(</strong><em>integer</em> <strong>$offset</strong>)</strong> : <em>void</em><br /><em>Offset to unset</em> |
| public | <strong>removeAttrib(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Vein\Core\Tools\Traits\DIaware,
		\Vein\Core\Tools\Traits\EventsAware,
		\Vein\Core\Tools\Traits\Resource,
		\Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Remove element attribute</em> |
| public | <strong>render(</strong><em>string</em> <strong>$content=`''`</strong>)</strong> : <em>string</em><br /><em>Render object</em> |
| public | <strong>rewind()</strong> : <em>void</em><br /><em>Rewind the Iterator to the first element</em> |
| public | <strong>serialize()</strong> : <em>string</em><br /><em>String representation of object</em> |
| public | <strong>setAction(</strong><em>string</em> <strong>$action</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set action</em> |
| public | <strong>setAttrib(</strong><em>string</em> <strong>$key</strong>, <em>mixed/string</em> <strong>$value=null</strong>)</strong> : <em>\Vein\Core\Tools\Traits\DIaware,
		\Vein\Core\Tools\Traits\EventsAware,
		\Vein\Core\Tools\Traits\Resource,
		\Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Add element attribute</em> |
| public | <strong>setAttribs(</strong><em>array</em> <strong>$attribs</strong>)</strong> : <em>\Vein\Core\Tools\Traits\DIaware,
		\Vein\Core\Tools\Traits\EventsAware,
		\Vein\Core\Tools\Traits\Resource,
		\Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Set element attributes</em> |
| public | <strong>setAutoloadMethodPrefix(</strong><em>string</em> <strong>$prefix</strong>)</strong> : <em>\Vein\Core\Tools\Traits\Resource</em><br /><em>Set $_autoloadMethodPrefix</em> |
| public | <strong>setAutoloadMethodPrefixException(</strong><em>array</em> <strong>$prefixes</strong>)</strong> : <em>\Vein\Core\Tools\Traits\Resource</em><br /><em>Set $_autoloadMethodPrefixException</em> |
| public | <strong>setDi(</strong><em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>)</strong> : <em>void</em><br /><em>Sets the dependency injector</em> |
| public | <strong>setEventsManager(</strong><em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>void</em><br /><em>Sets the events manager</em> |
| public | <strong>setExtraLimitMoreTimes(</strong><em>int</em> <strong>$limit</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set limit that will use in container model query</em> |
| public | <strong>setFilterParam(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set filter param</em> |
| public | <strong>setHelpers(</strong><em>array</em> <strong>$helpers</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Renderer</em><br /><em>Set helpers</em> |
| public | <strong>setId(</strong><em>string</em> <strong>$id</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set id param</em> |
| public | <strong>setLimit(</strong><em>int</em> <strong>$limit</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set limit param</em> |
| public | <strong>setNoCountQuery(</strong><em>mixed</em> <strong>$count</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set count query flag</em> |
| public | <strong>setPage(</strong><em>int</em> <strong>$page</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set page param</em> |
| public | <strong>setParam(</strong><em>string</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set param</em> |
| public | <strong>setParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set grid params</em> |
| public | <strong>setSort(</strong><em>string</em> <strong>$sort</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set sort param</em> |
| public | <strong>setSortDirection(</strong><em>string</em> <strong>$dependencyInjectorrection</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set direction param</em> |
| public | <strong>setStrictMode(</strong><em>bool</em> <strong>$strict=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Base</em><br /><em>Set strict mode</em> |
| public | <strong>setTitle(</strong><em>string</em> <strong>$title</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set title</em> |
| public | <strong>toJson()</strong> : <em>string</em><br /><em>Return data in json format</em> |
| public | <strong>toogleSortDirection()</strong> : <em>string</em><br /><em>Get direction param</em> |
| public | <strong>unserialize(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Constructs the object</em> |
| public | <strong>useColumNameForKey(</strong><em>bool/boolean</em> <strong>$useColumNameForKey=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set flag to use columns name for getting  columns value from data</em> |
| public | <strong>valid()</strong> : <em>boolean</em><br /><em>Checks if current position is valid</em> |
| protected | <strong>_beforeRender()</strong> : <em>string</em><br /><em>Do something before render</em> |
| protected | <strong>_executingResource(</strong><em>string</em> <strong>$resource</strong>)</strong> : <em>void</em><br /><em>Execute a resource. Checks to see if the resource has already been run. If not, it searches first to see if a local method matches the resource, and executes that. If not, it checks to see if a plugin resource matches, and executes that if found. Finally, if not found, it throws an exception.</em> |
| protected | <strong>abstract _initColumns()</strong> : <em>void</em><br /><em>Initialize columns</em> |
| protected | <strong>_initContainer()</strong> : <em>void</em><br /><em>Initialize container</em> |
| protected | <strong>_initDecorator()</strong> : <em>void</em><br /><em>Initialize decorator</em> |
| protected | <strong>abstract _initFilters()</strong> : <em>void</em><br /><em>Initialize filters</em> |
| protected | <strong>_initForm()</strong> : <em>void</em><br /><em>Initialize form</em> |
| protected | <strong>_initResource()</strong> : <em>void</em><br /><em>Get all object method</em> |
| protected | <strong>_markRun(</strong><em>string</em> <strong>$resource</strong>)</strong> : <em>void</em><br /><em>Mark a resource as having run</em> |
| protected | <strong>_paginate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Paginate data array</em> |
| protected | <strong>_runResourceMethods()</strong> : <em>void</em><br /><em>Execute all _setup* methods in class</em> |
| protected | <strong>_setData()</strong> : <em>void</em><br /><em>Set grid data from Container object</em> |
| protected | <strong>_setOptions(</strong><em>array</em> <strong>$options</strong>)</strong> : <em>void</em><br /><em>Set extra grid options before inititialize</em> |
| protected | <strong>_setupContainer()</strong> : <em>void</em><br /><em>Setup container</em> |
| protected | <strong>_setupFilter()</strong> : <em>void</em><br /><em>Setup filter</em> |
| protected | <strong>_setupGrid()</strong> : <em>void</em><br /><em>Setup grid</em> |
| protected | <strong>updateDataSource(</strong><em>mixed</em> <strong>$dataSource</strong>)</strong> : <em>void</em><br /><em>Update container data source</em> |

*This class implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \ArrayAccess, \Countable, \Iterator, \Traversable, \Serializable*

<hr /> 
### Class: \Vein\Core\Crud\Helper (abstract)

> Class Helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getSeparator()</strong> : <em>string</em><br /><em>Return</em> |
| public static | <strong>init(</strong><em>mixed</em> <strong>$element</strong>)</strong> : <em>void</em><br /><em>Helper initialize method</em> |

*This class extends \Phalcon\Tag*

<hr /> 
### Class: \Vein\Core\Crud\Container\Mysql (abstract)

> Class container for Mysql

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addJoin(</strong><em>string</em> <strong>$model</strong>)</strong> : <em>string</em><br /><em>Add join model</em> |
| public | <strong>clearDataSource()</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Nulled data source object</em> |
| public | <strong>getDataSource()</strong> : <em>\Vein\Core\Mvc\Model\Query\Builder</em><br /><em>Return data source object</em> |
| public | <strong>setAdapter(</strong><em>mixed/string</em> <strong>$adapter=null</strong>)</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Set model adapter</em> |
| public | <strong>setColumn(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$name</strong>, <em>bool/boolean</em> <strong>$useTableAlias=true</strong>, <em>bool/boolean</em> <strong>$useCorrelationTableName=false</strong>)</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Set column</em> |
| public | <strong>setJoinModels(</strong><em>array</em> <strong>$models</strong>)</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Set join models</em> |
| public | <strong>setModel(</strong><em>mixed/string</em> <strong>$model=null</strong>)</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Initialize container model</em> |
| protected | <strong>abstract _setDataSource()</strong> : <em>void</em><br /><em>Set datasource</em> |
| protected | <strong>_setModelAdapter(</strong><em>\Vein\Core\Mvc\Model</em> <strong>$model</strong>)</strong> : <em>void</em><br /><em>Set model connection adapter</em> |

*This class extends \Vein\Core\Crud\Container\AbstractContainer*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Crud\Container\Form\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Vein\Core\Exception*

<hr /> 
### Class: \Vein\Core\Crud\Container\Grid\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Vein\Core\Exception*

<hr /> 
### Class: \Vein\Core\Crud\Container\Grid\Mysql\Elasticsearch

> Class container for MySql with using ElasticSearch filters

| Visibility | Function |
|:-----------|:---------|
| public | <strong>clearDataSource()</strong> : <em>[\Vein\Core\Crud\Container\Mysql](#class-veincorecrudcontainermysql-abstract)</em><br /><em>Nulled data source object</em> |
| public | <strong>getData(</strong><em>mixed</em> <strong>$dataSource</strong>)</strong> : <em>array</em><br /><em>Return data array</em> |
| public | <strong>getElasticDataSource()</strong> : <em>\Vein\Core\Mvc\Model\Query\Builder</em><br /><em>Return data source object</em> |
| public | <strong>getFilter()</strong> : <em>\Vein\Core\Filter\SearchFilterInterface</em><br /><em>Return filter object</em> |
| public | <strong>getFilterClass(</strong><em>string</em> <strong>$type</strong>)</strong> : <em>string</em><br /><em>Return filter class name</em> |
| public | <strong>useIndexData()</strong> : <em>[\Vein\Core\Crud\Container\Grid\Mysql\Elasticsearch](#class-veincorecrudcontainergridmysqlelasticsearch)</em><br /><em>Set flag to use index data for build grid data</em> |
| protected | <strong>_getData(</strong><em>\Vein\Core\Mvc\Model\Query\Builder</em> <strong>$datasource</strong>, <em>array</em> <strong>$ids</strong>)</strong> : <em>array</em><br /><em>Get data from grid mysql datasource by primary field</em> |
| protected | <strong>_getFunctionScoreQuery(</strong><em>\Vein\Core\Search\Elasticsearch\Query\Builder</em> <strong>$queryBuilder</strong>, <em>array</em> <strong>$functionScoreParams</strong>)</strong> : <em>\Elastica\Query\FunctionScore</em><br /><em>Initialaize FunctionScore query object</em> |
| protected | <strong>_getPaginator(</strong><em>\Vein\Core\Search\Elasticsearch\Query\Builder</em> <strong>$queryBuilder</strong>, <em>mixed</em> <strong>$extraLimit</strong>, <em>mixed</em> <strong>$limit</strong>, <em>mixed</em> <strong>$page</strong>, <em>bool</em> <strong>$total=false</strong>)</strong> : <em>\ArrayObject</em><br /><em>Setup paginator.</em> |
| protected | <strong>_setElasticDataSource()</strong> : <em>void</em><br /><em>Set datasource</em> |

*This class extends \Vein\Core\Crud\Container\Grid\Mysql*

*This class implements \Vein\Core\Crud\Container\Grid\Adapter, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Crud\Container\Grid\Mysql\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Vein\Core\Exception*

<hr /> 
### Class: \Vein\Core\Crud\Form\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Vein\Core\Exception*

<hr /> 
### Class: \Vein\Core\Crud\Form\Extjs (abstract)

> Class Extjs.

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>deleteRows(</strong><em>mixed</em> <strong>$params</strong>, <em>mixed</em> <strong>$key</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>string</em><br /><em>Delete rows by id values.</em> |
| public | <strong>getAction()</strong> : <em>string</em><br /><em>Get form action</em> |
| public | <strong>getGridData()</strong> : <em>array</em><br /><em>Return data in grid data type</em> |
| public | <strong>getKey()</strong> : <em>string</em><br /><em>Return extjs form key</em> |
| public | <strong>getLink()</strong> : <em>string</em><br /><em>Generate form item link from link template</em> |
| public | <strong>getModuleName()</strong> : <em>string</em><br /><em>Return extjs module name</em> |
| public | <strong>getModulePrefix()</strong> : <em>string</em><br /><em>Get grid action</em> |
| public static | <strong>updateRow(</strong><em>string/array/\stdClass</em> <strong>$row</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>array</em><br /><em>Update from row</em> |
| public static | <strong>updateRows(</strong><em>string/array/\stdClass</em> <strong>$params</strong>, <em>string</em> <strong>$key</strong>, <em>\Phalcon\DiInterface</em> <strong>$dependencyInjector=null</strong>, <em>\Phalcon\Events\ManagerInterface</em> <strong>$eventsManager=null</strong>)</strong> : <em>array</em><br /><em>Update form rows</em> |

*This class extends \Vein\Core\Crud\Form*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \ArrayAccess*

<hr /> 
### Class: \Vein\Core\Crud\Form\Field\ManyToMany

> ManyToMany field

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed/string</em> <strong>$label=null</strong>, <em>string</em> <strong>$model</strong>, <em>string</em> <strong>$workingModel</strong>, <em>mixed/string</em> <strong>$optionName=null</strong>, <em>mixed/string</em> <strong>$desc=null</strong>, <em>bool</em> <strong>$required=false</strong>, <em>mixed/int</em> <strong>$width=450</strong>, <em>array</em> <strong>$default=array()</strong>, <em>bool</em> <strong>$saveAllParents=false</strong>, <em>mixed/string</em> <strong>$modelParentField=null</strong>, <em>array</em> <strong>$additionalColumns=array()</strong>, <em>bool</em> <strong>$loadOptions=false</strong>)</strong> : <em>void</em> |
| public | <strong>getCount(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>array</em><br /><em>Return options array</em> |
| public | <strong>getOptionIds(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>array</em><br /><em>Generate and return array of saved options rows.</em> |
| public | <strong>getOptionIdsByNames(</strong><em>array</em> <strong>$names</strong>)</strong> : <em>array</em> |
| public | <strong>getOptions(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>array</em><br /><em>Return options array</em> |
| public | <strong>getSaveData()</strong> : <em>array/bool</em><br /><em>Return field save data</em> |
| public | <strong>getSavedData(</strong><em>mixed</em> <strong>$id=null</strong>)</strong> : <em>array</em><br /><em>Fetch and return all saved options.</em> |
| public | <strong>isUpdated()</strong> : <em>bool</em><br /><em>Return was many to many update or not.</em> |
| public | <strong>notLoadOptions()</strong> : <em>[\Vein\Core\Crud\Form\Field\ManyToMany](#class-veincorecrudformfieldmanytomany)</em><br /><em>Set param _loadOptions to false</em> |
| public | <strong>postSaveAction(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Save data in many to many field.</em> |
| public | <strong>setOnchangeAction(</strong><em>string</em> <strong>$onchange</strong>)</strong> : <em>@return \Vein\Core\Crud\Form\Field\ManyToMany</em><br /><em>Set onchange action</em> |
| public | <strong>updateField()</strong> : <em>void</em><br /><em>Update field</em> |
| protected | <strong>_findAllParents(</strong><em>array</em> <strong>$ids</strong>)</strong> : <em>array</em><br /><em>Find all category parent ids for all save values</em> |
| protected | <strong>_getModel()</strong> : <em>\Vein\Core\Mvc\Model</em> |
| protected | <strong>_getWorkModel()</strong> : <em>\Vein\Core\Mvc\Model</em> |
| protected | <strong>_init()</strong> : <em>void</em><br /><em>Initialize field (used by extending classes)</em> |
| protected | <strong>_setCount(</strong><em>mixed</em> <strong>$params=null</strong>)</strong> : <em>void</em><br /><em>Set options</em> |
| protected | <strong>_setOptions(</strong><em>mixed</em> <strong>$params=null</strong>)</strong> : <em>void</em><br /><em>Set options</em> |
| protected | <strong>selectedArray(</strong><em>array</em> <strong>$selected</strong>)</strong> : <em>array</em><br /><em>Return linear array</em> |

*This class extends \Vein\Core\Crud\Form\Field*

*This class implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Vein\Core\Crud\Form\FieldInterface*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Vein\Core\Exception*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Extjs (abstract)

> Class Extjs.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getAction()</strong> : <em>string</em><br /><em>Get grid action</em> |
| public | <strong>getColumnData()</strong> : <em>array</em><br /><em>Return datas with column value</em> |
| public | <strong>getData()</strong> : <em>array</em><br /><em>Return grid fetching data</em> |
| public | <strong>getDataWithRenderValues()</strong> : <em>array</em><br /><em>Return datas with rendered values.</em> |
| public | <strong>getEditingType()</strong> : <em>string</em><br /><em>Return grid editing type</em> |
| public | <strong>getHeight()</strong> : <em>integer</em><br /><em>Return grid height</em> |
| public | <strong>getKey()</strong> : <em>string</em><br /><em>Return extjs grid key</em> |
| public | <strong>getModuleName()</strong> : <em>string</em><br /><em>Return extjs module name</em> |
| public | <strong>getModulePrefix()</strong> : <em>string</em><br /><em>Get grid action</em> |
| public | <strong>getSortParams(</strong><em>bool</em> <strong>$withFilterParams=true</strong>)</strong> : <em>array</em><br /><em>Return current sort params</em> |
| public | <strong>getWidth()</strong> : <em>integer</em><br /><em>Return grid width</em> |
| public | <strong>isBuildStore()</strong> : <em>boolean</em><br /><em>Is build store in extjs grid</em> |
| public | <strong>setParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Set grid params</em> |
| protected | <strong>_beforeRender()</strong> : <em>string</em><br /><em>Do something before render</em> |
| protected | <strong>_paginate(</strong><em>array</em> <strong>$data</strong>)</strong> : <em>void</em><br /><em>Paginate data array</em> |

*This class extends [\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)*

*This class implements \Serializable, \Traversable, \Iterator, \Countable, \ArrayAccess, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Column (abstract)

> Class abstract grid column.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$title</strong>, <em>mixed/string</em> <strong>$name=null</strong>, <em>bool</em> <strong>$isSortable=true</strong>, <em>bool</em> <strong>$isHidden=false</strong>, <em>mixed/int</em> <strong>$width=160</strong>, <em>bool</em> <strong>$isEditable=true</strong>, <em>mixed/string</em> <strong>$fieldKey=null</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>addAttribs(</strong><em>array</em> <strong>$attribs</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Set element attributes</em> |
| public | <strong>addFilter(</strong><em>mixed</em> <strong>$filter</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters</em><br /><em>Add a filter to the element</em> |
| public | <strong>addFilters(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters</em><br /><em>Add filters to element</em> |
| public | <strong>addValidator(</strong><em>mixed</em> <strong>$validator</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Validators</em><br /><em>Add a filter to the element</em> |
| public | <strong>addValidators(</strong><em>array</em> <strong>$validators</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Validators</em><br /><em>Add Validators to element</em> |
| public | <strong>clearAttribs()</strong> : <em>\Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Clear element attributes</em> |
| public | <strong>clearFilters()</strong> : <em>\Vein\Core\Crud\Tools\Filters</em><br /><em>Clear all filters</em> |
| public | <strong>clearValidators()</strong> : <em>\Vein\Core\Crud\Tools\Validators</em><br /><em>Clear all validators</em> |
| public | <strong>createValidator(</strong><em>mixed</em> <strong>$validator</strong>)</strong> : <em>\Phalcon\Validation\ValidatorInterface</em><br /><em>Create validator</em> |
| public | <strong>filter(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em><br /><em>Returns the result of filtering $value</em> |
| public | <strong>getAction()</strong> : <em>string</em><br /><em>Return action for column</em> |
| public | <strong>getActionParam()</strong> : <em>string</em><br /><em>Return action param name</em> |
| public | <strong>getAttrib(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return element attribute</em> |
| public | <strong>getAttribs()</strong> : <em>array</em><br /><em>Return element attributes</em> |
| public | <strong>getField()</strong> : <em>\Vein\Core\Crud\Form\Field</em><br /><em>Return form field</em> |
| public | <strong>getFieldKey()</strong> : <em>string</em><br /><em>Return form key name.</em> |
| public | <strong>getFilterClassName(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return filter class name</em> |
| public | <strong>getFilters()</strong> : <em>array</em><br /><em>Get all filters</em> |
| public | <strong>getGrid()</strong> : <em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em><br /><em>Return column title.</em> |
| public | <strong>getKey()</strong> : <em>string</em><br /><em>Return key name.</em> |
| public | <strong>getName()</strong> : <em>string</em><br /><em>Return column name.</em> |
| public | <strong>getSortDirection()</strong> : <em>string</em><br /><em>Return current grid sort direction param.</em> |
| public | <strong>getSortParams(</strong><em>bool</em> <strong>$withFilterParams=true</strong>)</strong> : <em>array</em><br /><em>Return column sort params</em> |
| public | <strong>getTitle()</strong> : <em>string</em><br /><em>Returngrid object.</em> |
| public | <strong>getType()</strong> : <em>string</em><br /><em>Return column render type.</em> |
| public | <strong>getValidatorClassName(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return validator class name</em> |
| public | <strong>getValidators()</strong> : <em>array</em><br /><em>Return field validators</em> |
| public | <strong>getValue(</strong><em>mixed</em> <strong>$row</strong>)</strong> : <em>string/integer</em><br /><em>Return column value by key</em> |
| public | <strong>getWidth()</strong> : <em>integer</em><br /><em>Return column width</em> |
| public | <strong>init(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>, <em>string</em> <strong>$key</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set grid object and init grid column key.</em> |
| public | <strong>isEditable()</strong> : <em>mixed</em><br /><em>Is column can be editing</em> |
| public | <strong>isHidden()</strong> : <em>bool</em><br /><em>Is column hidden.</em> |
| public | <strong>isSortable()</strong> : <em>bool</em><br /><em>Check is column sortable.</em> |
| public | <strong>isSorted()</strong> : <em>bool</em><br /><em>Check is column sort</em> |
| public | <strong>removeAttrib(</strong><em>string</em> <strong>$key</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Remove element attribute</em> |
| public | <strong>removeFilter(</strong><em>string</em> <strong>$name</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters</em><br /><em>Remove a filter by name</em> |
| public | <strong>abstract render(</strong><em>mixed</em> <strong>$row</strong>)</strong> : <em>string</em><br /><em>Render column</em> |
| public | <strong>setAction(</strong><em>string</em> <strong>$action</strong>, <em>bool/string</em> <strong>$actionParam=false</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set action to grid column, with post param key name. Set param key name without "=".</em> |
| public | <strong>setAttrib(</strong><em>string</em> <strong>$key</strong>, <em>mixed/string</em> <strong>$value=null</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Add element attribute</em> |
| public | <strong>setAttribs(</strong><em>array</em> <strong>$attribs</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\Attributes</em><br /><em>Set element attributes</em> |
| public | <strong>setEditable(</strong><em>bool</em> <strong>$editable</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set if data by column can be edit</em> |
| public | <strong>setFilters(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Filters</em><br /><em>Add filters to element, overwriting any already existing</em> |
| public | <strong>setHidden(</strong><em>bool</em> <strong>$hidden</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set if data by column is hidden</em> |
| public | <strong>setSortable(</strong><em>bool</em> <strong>$sortable</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set if data can be sort by column</em> |
| public | <strong>setStrictMode(</strong><em>bool</em> <strong>$strict=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Base</em><br /><em>Set strict mode</em> |
| public | <strong>setValidators(</strong><em>array</em> <strong>$validators</strong>)</strong> : <em>\Vein\Core\Crud\Tools\Validators</em><br /><em>Add Validators to element, overwriting any already existing</em> |
| public | <strong>toogleSortDirection()</strong> : <em>string</em><br /><em>Return current grid sort direction param.</em> |
| public | <strong>abstract updateContainer(</strong><em>\Vein\Core\Crud\Container\Grid\Adapter</em> <strong>$container</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Update grid container</em> |
| public | <strong>updateDataSource(</strong><em>mixed</em> <strong>$dataSource</strong>)</strong> : <em>void</em><br /><em>Update container data source</em> |
| public | <strong>useColumNameForKey(</strong><em>bool/boolean</em> <strong>$useColumNameForKey=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set flag to use column name for getting value from data</em> |
| public | <strong>useCorrelationTableName(</strong><em>bool/boolean</em> <strong>$useCorrelationTableName=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set flag to add correlation table alias</em> |
| public | <strong>useTableAlias(</strong><em>bool/boolean</em> <strong>$useTableAlias=true</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set flag to add table alias</em> |
| protected | <strong>_getPage()</strong> : <em>integer</em><br /><em>Return current grid page number.</em> |
| protected | <strong>_init()</strong> : <em>void</em><br /><em>Initialize field (used by extending classes)</em> |
| protected | <strong>_initFilters()</strong> : <em>void</em><br /><em>Initialize filters</em> |

*This class implements \Vein\Core\Crud\Grid\ColumnInterface*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Column\Compound

> Class Compound

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$columns</strong>, <em>mixed/string</em> <strong>$title=null</strong>, <em>string</em> <strong>$separator=`', '`</strong>, <em>mixed/int</em> <strong>$width=160</strong>)</strong> : <em>void</em><br /><em>Construct</em> |
| public | <strong>getColumn(</strong><em>mixed</em> <strong>$key</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Return column by key</em> |
| public | <strong>getColumns()</strong> : <em>array</em><br /><em>Return columns</em> |
| public | <strong>getValue(</strong><em>mixed</em> <strong>$row</strong>)</strong> : <em>string/integer</em><br /><em>Return column value by key</em> |
| public | <strong>init(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>, <em>string</em> <strong>$key</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Set grid object and init grid column key.</em> |
| public | <strong>render(</strong><em>mixed</em> <strong>$row</strong>)</strong> : <em>string</em><br /><em>Return render value (non-PHPdoc)</em> |
| public | <strong>updateContainer(</strong><em>\Vein\Core\Crud\Container\Grid\Adapter</em> <strong>$container</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Update grid container</em> |

*This class extends [\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)*

*This class implements \Vein\Core\Crud\Grid\ColumnInterface*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Column\Action

> Class Action

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$items=array()</strong>, <em>mixed/int</em> <strong>$width=160</strong>)</strong> : <em>void</em><br /><em>Construct</em> |
| public | <strong>getItems()</strong> : <em>array</em><br /><em>Return action items</em> |
| public | <strong>render(</strong><em>array</em> <strong>$row</strong>)</strong> : <em>string</em><br /><em>Return render value</em> |
| public | <strong>renderItem(</strong><em>array</em> <strong>$row</strong>, <em>array</em> <strong>$item</strong>)</strong> : <em>string</em><br /><em>Render item action</em> |
| public | <strong>updateContainer(</strong><em>\Vein\Core\Crud\Container\Grid\Adapter</em> <strong>$container</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Update grid container</em> |

*This class extends [\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)*

*This class implements \Vein\Core\Crud\Grid\ColumnInterface*

<hr /> 
### Class: \Vein\Core\Crud\Grid\Column\Custom

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$title</strong>, <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\callable/\Closure</em> <strong>$closure</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Column base constructor</em> |
| public | <strong>render(</strong><em>mixed</em> <strong>$row</strong>)</strong> : <em>string</em><br /><em>Render column</em> |
| public | <strong>updateContainer(</strong><em>\Vein\Core\Crud\Container\Grid\Adapter</em> <strong>$container</strong>)</strong> : <em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em><br /><em>Update grid container</em> |

*This class extends \Vein\Core\Crud\Grid\Column\Base*

*This class implements \Vein\Core\Crud\Grid\ColumnInterface*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Standart

> Class grid filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs

> Class grid filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs\Buttons

> Class form functions helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates form buttons objects</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs\Functions

> Class form functions helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates form functions object</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper

> Class grid filter base helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getFieldHelper(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return extjs form field helper name</em> |
| public static | <strong>renderField(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render filter form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs\Components

> Class form components helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates form component object</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Extjs\Fields

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter</em> <strong>$filter</strong>)</strong> : <em>string</em><br /><em>Generates form fields object</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Standart

> Class grid filter field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Standart

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs text filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Join

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Combobox](#class-veincorecrudhelperfilterfieldextjscombobox)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Name

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Standart](#class-veincorecrudhelperfilterfieldextjsstandart)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\ArrayToSelect

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\Combobox](#class-veincorecrudhelperfilterfieldextjscombobox)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Combobox

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field/[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs combobox filter field</em> |
| protected static | <strong>_getStore(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return combobox datastore code</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Mail

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs mail filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper

> Class html form helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_implode(</strong><em>array</em> <strong>$components</strong>)</strong> : <em>string</em><br /><em>Implode field components to formated string</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Extjs\BaseHelper](#class-veincorecrudhelperfilterextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Checkbox

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs checkbox filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Numeric

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field/[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field\Numeric</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs number filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Primary

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs primary filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Extjs\Date

> Class filter fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field/[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field\Date</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs date filter field</em> |

*This class extends [\Vein\Core\Crud\Helper\Filter\Field\Extjs\BaseHelper](#class-veincorecrudhelperfilterfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Standart\Description

> Class grid filter field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Standart\Message

> Class grid filter field message helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Standart\Element

> Class grid filter field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Filter\Field\Standart\Label

> Class grid filter field label helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)\Filter\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Standart

> Class grid filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form</em> <strong>$crudForm</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs

> Class html form helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html form</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Buttons

> Class form functions helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates form buttons objects</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Model

> Class extjs grid model helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>_check(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Checkbox</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render checkbox field type</em> |
| public static | <strong>_collection(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render collection field type</em> |
| public static | <strong>_date(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Date</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render date model field type</em> |
| public static | <strong>_file(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\File</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render file field type</em> |
| public static | <strong>_image(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Image</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render image field type</em> |
| public static | <strong>_int(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render numeric field type</em> |
| public static | <strong>_string(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render string model field type</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Functions

> Class form functions helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates form functions object</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\BaseHelper

> Class html form helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getFieldHelper(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return extjs form field helper name</em> |
| public static | <strong>renderField(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render filter form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Components

> Class form components helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates form component object</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Fields

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates form fields object</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Extjs\Store

> Class form filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$form</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html form</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Standart

> Class form field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid filter</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Name

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\Text](#class-veincorecrudhelperformfieldextjstext)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\ManyToOne

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\Combobox](#class-veincorecrudhelperformfieldextjscombobox)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\ArrayToSelect

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\Combobox](#class-veincorecrudhelperformfieldextjscombobox)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Password

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Password</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs password form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Combobox

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs combobox form field</em> |
| protected static | <strong>_getListeners(</strong><em>\Vein\Core\Crud\Form\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return combobox listeners code</em> |
| protected static | <strong>_getStore(</strong><em>\Vein\Core\Crud\Form\Field\ArrayToSelect</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return combobox datastore code</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Mail

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs mail form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper

> Class html form helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_implode(</strong><em>array</em> <strong>$components</strong>)</strong> : <em>string</em><br /><em>Implode field components to formated string</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Extjs\BaseHelper](#class-veincorecrudhelperformextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Checkbox

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs checkbox form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\File

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\File</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs text form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Numeric

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Numeric</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs number form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\ManyToMany

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Form\Field\ManyToMany](#class-veincorecrudformfieldmanytomany)</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs combobox form field</em> |
| protected static | <strong>_getListeners(</strong><em>[\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)\Form\Field\Extjs\Field\ArrayToSelect/[\Vein\Core\Crud\Form\Field\ManyToMany](#class-veincorecrudformfieldmanytomany)</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return combobox listeners code</em> |
| protected static | <strong>_getStore(</strong><em>[\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)\Form\Field\Extjs\Field\ArrayToSelect/[\Vein\Core\Crud\Form\Field\ManyToMany](#class-veincorecrudformfieldmanytomany)</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Return combobox datastore code</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\TextArea

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs text form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Image

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Image</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs image file uplaod form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Primary

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs primary form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\HtmlEditor

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs text form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Text

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs text form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Extjs\Date

> Class form fields helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field/\Vein\Core\Crud\Form\Field\Date</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Render extjs date form field</em> |

*This class extends [\Vein\Core\Crud\Helper\Form\Field\Extjs\BaseHelper](#class-veincorecrudhelperformfieldextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Standart\Description

> Class grid Form field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid Form</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Standart\Message

> Class grid Form field message helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid Form</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Standart\Element

> Class grid Form field helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid Form</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Form\Field\Standart\Label

> Class grid Form field label helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>\Vein\Core\Crud\Form\Field</em> <strong>$field</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid Form</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Standart

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Filter

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Dojo

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Jade

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Dojo\Div

> Class dojo div helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a dojo grid layout</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Dojo\Layout

> Class dojo layuot helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a dojo grid layout</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Dojo\Datastore

> Class dojo datastore helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a dojo grid datastore</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Model

> Class extjs grid model helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>_action(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column\Action](#class-veincorecrudgridcolumnaction)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render collection column type</em> |
| public static | <strong>_check(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Status</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render checkbox column type</em> |
| public static | <strong>_collection(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Collection</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render collection column type</em> |
| public static | <strong>_date(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Date</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render date model column type</em> |
| public static | <strong>_file(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Numeric</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render file column type</em> |
| public static | <strong>_image(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Image</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render image column type</em> |
| public static | <strong>_int(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Numeric</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render numeric column type</em> |
| public static | <strong>_string(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render string model column type</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Window

> Class grid window helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid functions object</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Columns

> Class grid columns helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid columns object</em> |
| public static | <strong>_action(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column\Action](#class-veincorecrudgridcolumnaction)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render collection column type</em> |
| public static | <strong>_check(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Status</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render collection column type</em> |
| public static | <strong>_collection(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Collection</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render collection column type</em> |
| public static | <strong>_column(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render grid colum</em> |
| public static | <strong>_date(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Date</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render date column type</em> |
| public static | <strong>_image(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render grid colum</em> |
| public static | <strong>_implode(</strong><em>array</em> <strong>$components</strong>)</strong> : <em>string</em><br /><em>Implode column components to formated string</em> |
| public static | <strong>_int(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)/[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)\Numeric</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render date column type</em> |
| public static | <strong>_string(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Render string model column type</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Functions

> Class grid functions helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid functions object</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>addRequires(</strong><em>array/string</em> <strong>$requires</strong>)</strong> : <em>void</em><br /><em>Add list of classes that have to be loaded before instantiating this class</em> |
| public static | <strong>createJs()</strong> : <em>boolean</em><br /><em>Is create js file prototype</em> |
| public static | <strong>getControllerName()</strong> : <em>string</em><br /><em>Return controller object name</em> |
| public static | <strong>getFilterName()</strong> : <em>string</em><br /><em>Return grid filter object name</em> |
| public static | <strong>getFormModelName()</strong> : <em>string</em><br /><em>Return form model object name</em> |
| public static | <strong>getFormName()</strong> : <em>string</em><br /><em>Return form object name</em> |
| public static | <strong>getFormStoreName()</strong> : <em>string</em><br /><em>Return store object name</em> |
| public static | <strong>getGridModelName()</strong> : <em>string</em><br /><em>Return grid model object name</em> |
| public static | <strong>getGridName()</strong> : <em>string</em><br /><em>Return grid object name</em> |
| public static | <strong>getGridStoreName()</strong> : <em>string</em><br /><em>Return store object name</em> |
| public static | <strong>getJsFilePath(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>string</em><br /><em>Return js file path from name</em> |
| public static | <strong>getName()</strong> : <em>false</em><br /><em>Return object name</em> |
| public static | <strong>getRequires(</strong><em>bool</em> <strong>$nomilize=false</strong>)</strong> : <em>array/string</em><br /><em>Return list of classes that have to be loaded before instantiating this class</em> |
| public static | <strong>getStoreLocalName()</strong> : <em>string</em><br /><em>Return grid object name</em> |
| public static | <strong>getWinName()</strong> : <em>string</em><br /><em>Return window object name</em> |
| public static | <strong>init(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)/[\Vein\Core\Crud\Form\Extjs](#class-veincorecrudformextjs-abstract)</em> <strong>$element</strong>)</strong> : <em>string</em><br /><em>Init helper</em> |
| public static | <strong>setRequires(</strong><em>array/string</em> <strong>$requires</strong>)</strong> : <em>void</em><br /><em>Set list of classes that have to be loaded before instantiating this class</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Filter

> Class html grid helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Paginator

> Class grid paginator helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid paginate object</em> |
| public static | <strong>clearUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$clearArray</strong>)</strong> : <em>string</em><br /><em>Clear query params from url</em> |
| public static | <strong>parseStr(</strong><em>mixed</em> <strong>$urlParamStr</strong>)</strong> : <em>array</em> |
| public static | <strong>setUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$paramName</strong>, <em>mixed</em> <strong>$paramValue=null</strong>, <em>bool</em> <strong>$urlDecode=false</strong>)</strong> : <em>void</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Components

> Class grid components helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid component object</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Controller

> Class extjs grid controller helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Store

> Class grid filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Extjs\Store\Local

> Class grid filter helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid\Extjs](#class-veincorecrudgridextjs-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates a widget to show a html grid</em> |
| public static | <strong>endTag()</strong> : <em>string</em><br /><em>Crud helper end tag</em> |
| public static | <strong>getName()</strong> : <em>string</em><br /><em>Return object name</em> |

*This class extends [\Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper](#class-veincorecrudhelpergridextjsbasehelper)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Jade\Columns

> Class grid columns helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid table colums head</em> |
| public static | <strong>sortLink(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Create column sortable link</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Jade\Datastore

> Class grid datastore helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid table rows</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Jade\Paginator

> Class grid paginator helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid paginate code</em> |
| public static | <strong>clearUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$clearArray</strong>)</strong> : <em>string</em><br /><em>Clear query params from url</em> |
| public static | <strong>parseStr(</strong><em>mixed</em> <strong>$urlParamStr</strong>)</strong> : <em>array</em> |
| public static | <strong>setUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$paramName</strong>, <em>mixed</em> <strong>$paramValue=null</strong>, <em>bool</em> <strong>$urlDecode=false</strong>)</strong> : <em>void</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Standart\Columns

> Class grid columns helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid table colums head</em> |
| public static | <strong>sortLink(</strong><em>[\Vein\Core\Crud\Grid\Column](#class-veincorecrudgridcolumn-abstract)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Create column sortable link</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Standart\Datastore

> Class grid datastore helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid table rows</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Helper\Grid\Standart\Paginator

> Class grid paginator helper

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>_(</strong><em>[\Vein\Core\Crud\Grid](#class-veincorecrudgrid-abstract)</em> <strong>$grid</strong>)</strong> : <em>string</em><br /><em>Generates grid paginate code</em> |
| public static | <strong>clearUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$clearArray</strong>)</strong> : <em>string</em><br /><em>Clear query params from url</em> |
| public static | <strong>parseStr(</strong><em>mixed</em> <strong>$urlParamStr</strong>)</strong> : <em>array</em> |
| public static | <strong>setUrlParam(</strong><em>mixed</em> <strong>$url</strong>, <em>mixed</em> <strong>$paramName</strong>, <em>mixed</em> <strong>$paramValue=null</strong>, <em>bool</em> <strong>$urlDecode=false</strong>)</strong> : <em>void</em> |

*This class extends [\Vein\Core\Crud\Helper](#class-veincorecrudhelper-abstract)*

<hr /> 
### Class: \Vein\Core\Crud\Tools\Multiselect

> Class Multiselect

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>getFirstOption(</strong><em>mixed</em> <strong>$multiOptions</strong>)</strong> : <em>mixed</em> |
| public static | <strong>getNameById(</strong><em>mixed</em> <strong>$multiOptions</strong>, <em>mixed</em> <strong>$id=null</strong>, <em>string</em> <strong>$default=`'n/a'`</strong>)</strong> : <em>mixed</em> |
| public static | <strong>prepareOptions(</strong><em>\Vein\Core\Mvc\Model\Query\Builder</em> <strong>$queryBuilder</strong>, <em>mixed/string</em> <strong>$name=null</strong>, <em>mixed/string</em> <strong>$category=null</strong>, <em>mixed/string</em> <strong>$categoryName=null</strong>, <em>mixed/string</em> <strong>$where=null</strong>, <em>string</em> <strong>$emptyCategory=`'n/a'`</strong>, <em>string</em> <strong>$emptyItem=`'n/a'`</strong>, <em>bool</em> <strong>$multiselect=false</strong>, <em>bool</em> <strong>$fields=false</strong>, <em>mixed/null</em> <strong>$category_order=null</strong>)</strong> : <em>array</em> |
| public static | <strong>prepareOptionsAll(</strong><em>\Vein\Core\Mvc\Model\Query\Builder</em> <strong>$queryBuilder</strong>, <em>mixed</em> <strong>$name=null</strong>, <em>mixed</em> <strong>$category=null</strong>, <em>mixed</em> <strong>$categoryName=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>string</em> <strong>$emptyCategory=`'n/a'`</strong>, <em>string</em> <strong>$emptyItem=`'n/a'`</strong>, <em>bool</em> <strong>$multiselect=false</strong>, <em>mixed</em> <strong>$fields=null</strong>, <em>mixed</em> <strong>$category_order=null</strong>)</strong> : <em>void</em> |
| public static | <strong>selectCase(</strong><em>mixed</em> <strong>$field</strong>, <em>mixed</em> <strong>$options</strong>, <em>string</em> <strong>$table_name=`''`</strong>)</strong> : <em>void</em> |

