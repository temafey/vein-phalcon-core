<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms;

/**
 * Class Form
 *
 * @category    Vein\Core
 * @package     Forms
 */
class Form extends \Phalcon\Forms\Form
{
    /**
     * Action methods
     */
    CONST METHOD_GET     = 'get';
    CONST METHOD_POST    = 'post';

    /**
     * Action method
     * @var string
     */
    protected $_method = self::METHOD_GET;

    /**
     * Errors after failed action
     * @var array
     */
    protected $_errors = [];

    /**
     * Set from action method
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * Return action form method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * Set data to form
     *
     * @param array $data
     * @param bool $validate
     *
     * @return \Vein\Core\Forms\Form
     * @throws \Vein\Core\Exception
     */
    public function setData(array $data, $validate = true)
    {
        if ($validate && !$this->isValid($data)) {
            $messages = [];
            $this->_errors = [];
            foreach ($this->getMessages() as $message) {
                $result = [];
                $field = $message->getField();
                $result[] = "Field: ".$field;
                $result[] = "Type: ".$message->getType();
                $errorMessage = $message->getMessage();
                $result[] = "Message: ".$errorMessage;
                $messages[] = implode (", ", $result);
                //$messages[] = $message->getMessage();
                $this->_errors[$field] = $errorMessage;
            }
            throw new Exception(implode('; ', $messages));
        }
        $this->_data = $data;

        return $this;
    }

    /**
     * Return form element value
     *
     * @param string $name
     * @param object $entity
     * @param array $data
     *
     * @return mixed
     */
    /*public function getCustomValue($name, $entity, $data)
    {
        if (is_array($data) && array_key_exists($name, $data)) {
            return $data[$name];
        }
        if (is_array($this->_data) && array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return null;
    }*/

    /**
     * Return action errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

}