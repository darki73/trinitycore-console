## TrinityCore SOAP Console for PHP
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Code Quality][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]

### Creating SOAP account
In order to be able to use library, you have to create a dedicated **SOAP** account first.  
To do so, execute the following command in your worldserver console  
`accont create 2#1 accountPassword`  
where:
1. **2#1** - account ID, can be anything, but i suggest to use the next ***available*** id for the account
2. **accountPassword**  - a secure password for your **SOAP** account  

After it is done, we need to grant privileges to the account, this can be done by using the following command  
`account set gmlevel 2#1 3 -1`

### Initializing connection to the SOAP service
After **SOAP** account is created, we can proceed to the connection initialization for the library  
`$console = new \FreedomCore\TrinityCore\Console\Client('2#1', 'accountPassword');`  
That is it. Now you can use the library!

### Available Methods
Current implementation of the console client has the following ***'endpoints'***:  
1. **account()** - Allows you to perform various operations on specific account
2. **bnet()** - Allows you to manage related battle.net settings
3. **character()** - Allows you to perform various operations on specific settings
4. **gm()** - Allows you to 'talk' to GMs
5. **guild()** - Allows you to manage different guild specific settings
6. **lfg()** - Provides information about the LFG system
7. **reset()** - Allows you to reset different aspects of the character (or, all characters on the server)
8. **server()** - Allows you to manage different server related settings


#### Client Options
* **setAddress** - Set Server Address  
`$client->setAddress(string $serverAddress);`
* **getAddress** - Get Server Address  
`$client->getAddress();`
* **setPort** - Set Server Port  
`$client->setPort(int $serverPort);`
* **getPort** - Get Server Port  
`$client->getPort();`
* **getVersion** - Get Client Version  
`$client->getVersion();`
* **createConnection** - Initialize Connection To The Server (needs to be invoked if address/port has been changed)
`$client->createConnection();`
* **getClient** - Get Client Instance  
`$client->getClient();`

#### $console->account()
* **create()** - Create new account  
`$result = $console->account()->create(string $account, string $password);`
* **delete()** - Delete specified account  
`$result = $console->account()->delete(string $account);`
* **password()** - Set new password for the account  
`$result = $console->account()->password(string $oldPassword, string $newPassword, string $repeatPassword);`
* **setAddon()** - Set expansion version for specified account  
`$result = $console->account()->setAddon(string $account, int $addon);`
* **setGmLevel()** - Set Game Mater Level For Account  
`$result = $console->account()->setGmLevel(string $account, int $level, int $realm = -1);`
* **setSecRegmail()** - Sets the regmail for specified account  
`$result = $console->account()->setSecRegmail(string $account, string $regMail, string $repeatRegMail);`
* **setSecEmail()** - Set the email for specified account  
`$result = $console->account()->setSecEmail(string $account, string $email, string $repeatEmail);`
* **setPassword()** - Set password for account.  
`$result = $console->account()->setPassword(string $oldPassword, string $newPassword, string $repeatPassword);`

#### $console->bnet()
* **create** - Create new battle.net account  
`$result = $console->bnet()->create(string $email, string $password);`
* **gameAccountCreate** - Create game account for specified battle.net account  
`$result = $console->bnet()->gameAccountCreate(string $email);`
* **link** - Link existing game account with battle.net account  
`$result = $console->bnet()->link(string $email, string $login);`
* **unlink** - Unlink existing account from specified battle.net account  
`$result = $console->bnet()->unlink(string $account, string $password);`
* **listGameAccounts** - List game account on specified battle.net account  
`$result = $console->bnet()->listGameAccounts(string $email);`
* **setPassword** - Set new password for specified battle.net account  
`$result = $console->bnet()->setPassword(string $email, string $password, string $repeatPassword);`

#### $console->character()
* **unstuck** - Teleport specified player to specified location  
`$result = $console->character()->unstuck(string $playerName, string $location = 'graveyard');`
* **unmute** - Restore messaging functionality for specified character  
`$result = $console->character()->unmute(string $playerName);`
* **unban** - Unban character by name  
`$result = $console->character()->unban(string $playerName, $function = 'character');`
* **ban** - Ban specified character  
`$result = $console->character()->ban(string $playerName, $function = 'character');`
* **mute** - Disable characters messaging functionality  
`$result = $console->character()->mute(string $playerName, int $minutes, $reason = 'No reason given!');`
* **kick** - Kick player from game world  
`$result = $console->character()->kick(string $playerName, string $reason = 'No reason given!');`
* **customize** - Send "customise character" request on next login  
`$result = $console->character()->customize(string $playerName);`
* **changeFaction** - Send "change faction" request on next login  
`$result = $console->character()->changeFaction(string $playerName);`
* **changeRace** - Send "change race" request on next login  
`$result = $console->character()->changeRace(string $playerName);`
* **erase** - Completely delete character  
`$result = $console->character()->erase(string $playerName);`
* **level** - Increase/Decrease character level by the provided value  
`$result = $console->character()->level(string $playerName, int $level = 1);`
* **rename** - Send "change name" request on next login. IF $newName is provided, name will be forcefully changed  
`$result = $console->character()->rename(string $oldName, string $newName = '');`
* **reputation** - Show reputation information for selected character. Player MUST be online  
`$result = $console->character()->reputation(string $playerName);`
* **titles** - Show titles known by character. Player MUST be online  
`$result = $console->character()->titles(string $playerName);`
* **deletedDelete** - Delete characters which contain specified string in their name  
`$result = $console->character()->deletedDelete(string $playerName);`
* **deletedList** - Show deleted characters with specified string in their names  
`$result = $console->character()->deletedList(string $playerName);`
* **deletedRestore** - Restore deleted characters with specified string in their names  
`$result = $console->character()->deletedRestore(string $playerName);`
* **deletedOld** - Delete characters which was deleted more than $days ago  
`$result = $console->character()->deletedOld(string $playerName, int $days);`

#### $console->gm()
* **announce** - Send announcement to all Game Masters  
`$result = $console->gm()->announce(string $announcement);`
* **nameAnnounce** - Send announcement to all Game Masters (as console)  
`$result = $console->gm()->nameAnnounce(string $announcement);`
* **notify** - Send notification ot all Game Masters  
`$result = $console->gm()->notify(string $notification);`

#### $console->guild()
* **create** - Create new guild. Player MUST be online  
`$result = $console->guild()->create(string $leaderName, string $guildName);`
* **delete** - Delete specified guild  
`$result = $console->guild()->delete(string $guildName);`
* **invite** - Invite Specified Player To Specified Guild  
`$result = $console->guild()->invite(string $playerName, string $guildName);`
* **rename** - Rename Guild  
`$result = $console->guild()->rename(string $oldName, string $newName);`
* **info** - Get Information About Specified Guild  
`$result = $console->guild()->info(string $guildName);`

#### $console->lfg()
* **queue** - Show information about current LFG queues  
`$result = $console->lfg()->queue();`
* **clean** - Cleans current queue, only for DEBUG  
`$result = $console->lfg()->clean();`
* **options** - Shows current LFG options. IF value is set, updates existing value.  
`$result = $console->lfg()->options($value = '');`

#### $console->reset()
* **achievements** - Reset achievements for specified player  
`$result = $console->reset()->achievements(string $playerName);`
* **honor** - Reset honor for specified player  
`$result = $console->reset()->honor(string $playerName);`
* **level** - Reset level for specified player  
`$result = $console->reset()->level(string $playerName);`
* **spells** - Reset spells for specified player  
`$result = $console->reset()->spells(string $playerName);`
* **stats** - Reset stats for specified player  
`$result = $console->reset()->stats(string $playerName);`
* **talents** - Reset talents for specified player  
`$result = $console->reset()->talents(string $playerName);`
* **all** - Reset $type (talents/spells) for ALL players  
`$result = $console->reset()->all(string $type);`

#### $console->server()
* **corpses** - Trigger corpses expire check in world  
`$result = $console->server()->corpses();`
* **exit** - Terminate server NOW. Exit code 0  
`$result = $console->server()->exit();`
* **info** - Display server version and the number of connected players  
`$result = $console->server()->info();`
* **motd** - Show message of the day  
`$result = $console->server()->motd();`
* **plimit** - Without the argument passed, it will display current limit for players. With argument greater that 0, it will set the new limit for max players. 'reset' parameter may be used to set the value from config.  
`$result = $console->server()->plimit($parameter = '');`
* **setDiffTime** - Set Diff Time For Sever  
`$result = $console->server()->setDiffTime(int $diffTime);`
* **setLogLevel** - Set Log Level For Server  
`$result = $console->server()->setLogLevel(string $facility, string $name, int $logLevel);`
* **setMotd** - Set new message of the day  
`$result = $console->server()->setMotd(string $motd);`
* **setClosed** - Sets whether the world accepts new client connections  
`$result = $console->server()->setClosed(bool $isClosed);`
* **shutdown** - Shutdown server  
`$result = $console->server()->shutdown(int $timer, bool $force = false, int $code = 0);`
* **shutdownCancel** - Cancel the restart/shutdown timer if any  
`$result = $console->server()->shutdownCancel();`
* **saveAll** - Save all players.  
`$result = $console->server()->saveAll();`
* **notify** - Display a message to all online players  
`$result = $console->server()->notify(string $message);`
* **announce** - Send announcement  
`$result = $console->server()->announce(string $message);`


### P.S.
If you found any errors, or would like to suggest some 'extra' functionality, feel free to create a new [ISSUE](https://github.com/darki73/trinitycore-console/issues/new).

[ico-version]: https://img.shields.io/packagist/v/freedomcore/trinitycore-console.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/darki73/trinitycore-console/master.svg?style=flat-square
[ico-scrutinizer]: https://scrutinizer-ci.com/g/darki73/trinitycore-console/badges/quality-score.png?b=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/darki73/trinitycore-console.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/freedomcore/trinitycore-console.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/freedomcore/trinitycore-console
[link-travis]: https://travis-ci.org/darki73/trinitycore-console
[link-scrutinizer]: https://scrutinizer-ci.com/g/darki73/trinitycore-console/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/darki73/trinitycore-console
[link-downloads]: https://packagist.org/packages/freedomcore/trinitycore-console
[link-author]: https://github.com/darki73