<?php
namespace bingbing;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\item\Item;

class HOT extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command  $command, string $label, array $args):bool{
        if ($command->getName() == "hot"){
            switch ($args[0]){
                case "시작":
                    $sender->getServer()->broadcastMessage("§4[§f해쉬타임§4]§f 해쉬타임시작!!");
                    return true;
                    break;
                case "종료":
                    $sender->getServer()->broadcastMessage("§4[§f해쉬타임§4]§f 해쉬타임종료!!");
                    return true;
                    break;
            
                case "아이템주기":
                    if (isset($args[2]) && isset($args[1]) ){
                    $sender->getServer()->broadcastMessage("§4[§f해쉬타임§4]§f 해쉬타임보상으로 아이템코드 ".$args[1]."을 ".$args[2]."지급 받았습니다");
                    $id = explode(":", $args[1]);
                        foreach ($sender->getServer()->getOnlinePlayers() as $player){
                            if (isset($id[1])){
                                $item = new Item($id[0]);
                                $item->setCount($args[2]);
                                $item->setDamage($id[1]);
                                if (isset($args[3]) ){
                                    $item->setCustomName($args[3]) ;
                                    $player->getInventory()->addItem($item);

                                }
                                else {
                                    $player->getInventory()->addItem($item);
                                    
                                }
                                
                                return true;
                            }
                            else {
                                $item = new Item($id[0]);
                                $item->setCount($args[2]);
                                $item->setDamage(0);
                                if (isset($args[3]) ){
                                    $item->setCustomName($args[3]) ;
                                    $player->getInventory()->addItem($item);
                                    
                                }
                                else {
                                    $player->getInventory()->addItem($item);
                                    
                                }
                                return true;
                            }
                        }
                    }
                    else {
                        $sender->sendMessage("/hot 아이템주기 아이템코드 갯수 이름");
                        
                    }
                default:
                    $sender->sendMessage("/hot 시작/종료 / 아이템주기");
                    return true;
            }
        }
    }
}