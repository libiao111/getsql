
<?php
namespace Home\Model;
use Think\Model\RelationModel;
class FieldModel extends RelationModel
{
	protected $tableName = 'field';
	protected $_link = array(
		'datatype'=>array(
			'mapping_type'=>self::BELONGS_TO,
			'foreign_key'=>'data_id'
		)

	);
}

?>