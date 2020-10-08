<?php 

class Validate
{
  private $passed = false, $errors = [], $db = null;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function check($source, $items = []) {

    foreach ($items as $item => $rules) {    
      foreach ($rules as $rule => $rule_value) {

        $value = $source[$item];

        if ($rule =='required' && empty($value)) {
          $this->addError("{$item} is required");
        } else if (!empty($value)) {
          switch ($rule) {
            case 'min':
              if(strlen($value) < $rule_value){
                $this->addError("{$item} минимальное кол-во символов {$rule_value}");
              }
              break;

              case 'max':
              if(strlen($value) > $rule_value){
                $this->addError("{$item} максимальное кол-во символов {$rule_value}");
              }
              break;

              case 'matches':
              if($value != $source[$rule_value]){
                $this->addError("{$rule_value} не совпадают {$item}");
                }
              break;

              case 'unique':
                $check = $this->db->get($rule_value,[$item, '=', $value]);
                if($check->count()){
                  $this->addError("{$item} не уникальный");
                }
                case 'email':
                if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                  $this->addError("{$item} не является мылом");
                }
                
                break;
            
            }

          }

        }

      }
      if(empty($this->errors))
      {
        $this->passed = true;
    }
    return $this;
  }

  public function addError($error)
  {
    $this->errors[] = $error;
  }

  public function errors()
  {
    return $this->errors;
  }

  public function passed()
  {
    return $this->passed;
  }


}
