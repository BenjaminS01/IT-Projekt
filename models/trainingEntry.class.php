<?php
namespace Trainingskalender\models;
class TrainingEntry extends BaseModel {

    const TABLENAME = 'trainingEntry';
    protected $schema=[
    'id'=>['type'=>BaseModel::TYPE_INT],
    'trainingDate'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'typeOfTraining' =>['type'=> BaseModel::TYPE_ENUM_G],
    'changingRoom'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomBeforeStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomBeforeEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomAfterStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'changingRoomAfterEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'cardioStartTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'cardioEndTime'	=>['type'=>BaseModel::TYPE_STRING, 'min'=>2, 'max'=>50],
    'memberId'=>['type'=>BaseModel::TYPE_INT],
    'areaTimeslotId'=>['type'=>BaseModel::TYPE_INT]
    ];

    public function insertTrainingEntry(&$errors, $trainingDate)
    {
        $db = $GLOBALS['db'];
        try {
            $sql = 'insert into TrainingEntry WHERE NOT EXISTS(SELECT 
            FROM TABLE_2 t2
           WHERE trainingDate =\''.$trainingDate.'\' and startTime =\''.$trainingDate.'\')(';
            $valueString = 'values (';

/*
            INSERT INTO TABLE_2
  (id, name)
SELECT t1.id,
       t1.name
  FROM TABLE_1 t1
 WHERE NOT EXISTS(SELECT id
                    FROM TABLE_2 t2
                   WHERE t2.id = t1.id)
*/

            foreach ($this->schema as $key => $schemaOption) {
                $sql .= $key . ',';
                if ($this->data[$key] === null) {
                    $valueString .= 'NULL,';
                } else {
                    $valueString .= $db->quote($this->data[$key]) . ',';
                }
            }
            $sql = trim($sql, ',');
            $valueString = trim($valueString, ',');
            $sql .= ') ';
            $valueString .= '); ';
            $sql .= $valueString;
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $this->data['id'] = $db->lastInsertId();
            }
            $db=null;
            return true;
        } catch (\PDOException $e) {
            $errors[] = 'Error inserting ' . ' in' . get_called_class() . ':' . $e->getMessage();
        }
        return false;
    }

}
