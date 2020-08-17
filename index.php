<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Doctrine\Common\EventManager;
use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;

require_once "vendor/autoload.php";
$eventManager = new EventManager();


final class  cleanOrder {
    public const beforeCleanOrder = 'beforeCleanOrder';
    public $beforeCleanOrderInvoked = false;
    private $eventManager;
    public function __construct(EventManager $eventManager){
        $eventManager->addEventListener([self::beforeCleanOrder],$this);
    }
    public function beforeCleanOrder($data){
        echo "I have no idea what is going on";
        var_dump($data->getData());
        $this->beforeCleanOrderInvoked=true;
    }
}
$cleanOrder = new cleanOrder($eventManager);




var_dump($eventManager);

class myEventData extends EventArgs {
    private $data;
    public function addData($data){
$this->data=$data;
    }
    public function getData(){
        return $this->data;
    }
}
$d= new myEventData();
$d->addData(['hello','world',$eventManager]);
$eventManager->dispatchEvent(cleanOrder::beforeCleanOrder,$d);