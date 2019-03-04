<?php

namespace ElementalMinecraftGaming\RejectedDeath;

use pocketmine\CommandReader;
use pocketmine\CommandExecuter;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\event\TranslationContainer;
use pocketmine\utils\TextFormat;
use pocketmine\Server;
use pocketmine\item\item;
use pocketmine\inventory;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements listener {
    private $config;
    public function onEnable() {
        $this->getLogger()->info("Created by MrDevCat -Discord- ");
        @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (strtolower($command->getName()) == "Rejectset") {
            if ($sender->hasPermission("rejectedeath.admin")) {
                if ($sender instanceof Player) {
                    if (isset($args[0])) {
                                    $sender->sendMessage(TextFormat::GOLD . "Price or item for revive");
                                    $title = "require";
                                    $require = $args[0];
                                    $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
                                    $config->set($require, [$require]);
                                    $config->save();
                                    $sender->sendMessage(TextFormat::GOLD . "set $require set for revive");
                    } else {
                        $sender->sendMessage(TextFormat::RED . "require creation failed!");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "require creation failed!");
                }
            } else {
                $sender->sendMessage(TextFormat::RED . "require creation failed!");
                return false;
            }
        }
        if (strtolower($command->getName()) == "resetrequire") {
            if ($sender->hasPermission("rejectdeath.admin")) {
                if ($sender instanceof Player) {
                        $title = "deathreject";
                        $mode = "mode";
                        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
                        unset($config->$title);
                        unset($config->$mode);
                        $this->config->save(true);
                        $sender->sendMessage(TextFormat::RED . "Deleted $title! ");
                        return true;
                    } else {
                        $sender->sendMessage(TextFormat::RED . "Delete failed!");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "delete failed! ");
                }
            } else {
                $sender->sendMessage(TextFormat::RED . "delete failed! ");
                return false;
            }
        
        if (strtolower($command->getName()) == "setrequiremode") {
            if ($sender->hasPermission("rejectdeath.admin")) {
                if ($sender instanceof Player) {
                    if (isset($args[0])) {
                        $mode = "mode";
                        $modee = $args[0];
                        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
                        $config->set($mode, [$modee]);
                        $this->config->save(true);
                        $sender->sendMessage(TextFormat::RED . "Set mode to $modee! ");
                        return true;
                    } else {
                        $sender->sendMessage(TextFormat::RED . "Set failed!");
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED . "Set failed! ");
                }
            } else {
                $sender->sendMessage(TextFormat::RED . "Set failed! ");
                return false;
            }
        }
        return true;
    }
}
