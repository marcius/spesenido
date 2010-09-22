<?php
class ArrayDataProvider extends CDataProvider {
/**
* Constructor.
* @param string the model class. This will be assigned to the {@link modelClass} property.
* @param array configuration (name=>value) to be applied to this data provider.
* Any public properties of the data provider can be configured via this parameter
*/
 public function __construct($id,$data) {
  $this->setData($data);
  $this->setId($id);
 }
 //put your code here
  protected function calculateTotalItemCount() {
    return count($this->getData());
  }
  protected function fetchData() {
    return $this->getData();
  }
  protected function fetchKeys() {
    foreach ($this->getData() as $key=>$value) {
      $keys[]= $key;
    }
    return $keys;
  }
}
?>