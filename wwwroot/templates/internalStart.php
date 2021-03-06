<?php
require_once("internalSettings/internalCountries.php");
include_once('internalModal.php');
?>
<div id="playerInfo-tv-container">

    <!-- Player info when you hover the ship -->
    <div id="player-info">
        <!-- First box -->
        <div id="player-info-profile" class="invisible">
            <div id="player-info-profile-header">
                <span style="color: <?= $System->User->getTitleColor() ?>"><?= $System->User->getTitle() ?></span>
                <img alt='faction_logo'
                     src="<?= PROJECT_HTTP_ROOT ?>resources/images/factions/logo_<?= $System->User->getFactionName(
                     ) ?>.png"
                     width="37"
                     height="20" />
            </div><!-- /player-info-profile-header -->

            <div id="player-info-profile-body">
                <img alt='player_avatar'
                     src="<?= PROJECT_HTTP_ROOT ?>resources/images/avatars/default.png"
                     width="94"
                     height="94"
                     class="pull-left" />

                <ul class="pull-right">
                    <li><p><?= $System->User->__get('PLAYER_NAME') ?></p></li>
                    <?php if ($System->User->__get('CLAN_ID') != 0) {  ?>
                        <li><p><?=$System->User->getCurrentClan('NAME') ?><span class="bold"> [<?=$System->User->getCurrentClan('TAG') ?>]</span></p></li>
                    <?php } ?>
                    <li><p class="bold">TOP <?= $System->User->__get('RANKING') ?></p></li>
                    <li><p>General</p></li>
                </ul>
            </div><!-- /player-info-profile-body -->

        </div> <!-- /player-info-profile -->

        <!-- Player name (BIG) -->
        <div id="player-info-name">
            <p class="bold title"><?= $System->User->__get('PLAYER_NAME') ?></p>
        </div> <!-- /player-info-name -->

        <!-- Last box -->
        <div id="player-info-equipment" class="invisible">
            <div id="player-info-equipment-body">
                <p><?= $System->__('BODY_TEXT_DAMAGE') ?>: <span
                            id="ship-damage"><?= $System->User->__get('CONFIG_1_DMG') ?></span></p>
                <p><?= $System->__('BODY_TEXT_SHIELD') ?>: <span
                            id="ship-shield"><?= $System->User->__get('CONFIG_1_SHIELD') ?></span></p>
                <p><?= $System->__('BODY_TEXT_SPEED') ?>: <span
                            id="ship-speed"><?= $System->User->__get('CONFIG_1_SPEED') ?></span></p>
                <p><?= $System->__('BODY_TEXT_HP') ?>: <span
                            id="ship-health"><?= $System->User->Hangars->CURRENT_HANGAR->SHIP_HP ?></span></p>
            </div>  <!-- /player-info-equipment-body -->
        </div> <!-- /player-info-equipment -->

    </div> <!-- /player-info -->

    <div id="player-ship-box">
        <a target="_blank" href="./internalMapRevolution">
            <img alt='ship' src="<?= $System->User->getShipImage() ?>" id="ship" />
        </a>
        <?php
        if ($System->User->hasDrones()) {
            $dlevel = $System->User->getDroneLevel();
            $dtype = $System->User->getDroneType();
            ?>

            <img alt='drone' src="<?= Utils::getPathByLootId($dtype, 'top', $dlevel) ?>" id="drone"/>
            <?php
        }
        if ( $System->User->hasPet()) {
            $level = $System->User->getPetLevel();
            ?>
            <img alt='pet' src="<?= Utils::getPathByLootId('pet_pet10', 'top', $level) ?>" id="pet" />
            <?php
        }
        ?>
    </div> <!-- /player-ship-box -->

    <div id="tv-box">
        <div id="tv-state">
            <div id="tv-off" onclick="switchTvOn();">

            </div> <!-- /tv-off -->

            <div id="tv-on" class="invisible">
                <div class="tv-buttons">
                    <div id="news" class="tv-button"><p>News</p><span class="glyphicon glyphicon-globe"></span></div>
                    <div id="videos" class="tv-button"><p>Live</p><span class="glyphicon glyphicon-film"></span></div>
                    <div id="live" class="tv-button"><p>Players</p><span class="glyphicon glyphicon-user"></span></div>
                </div>
                <div class="tv-news invisible"><h2>News Channel</h2></div>
                <div class="tv-live invisible"></div>
                <div class="tv-players invisible"></div>
            </div> <!-- /tv-on -->
        </div> <!-- /tv-state -->
    </div> <!-- /tv-box -->

</div> <!-- /playerInfo-tv-container -->

<div id="tabs-container">
    <div id="tabs-content">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab"
                   class="bold"><?= $System->__('BODY_TEXT_STATS') ?></a>
            </li>
            <li role="presentation">
                <a href="#events" aria-controls="events" role="tab" data-toggle="tab"
                   class="bold"><?= $System->__('BODY_TEXT_EVENTS') ?></a>
            </li>
            <li role="presentation">
                <a href="#pilot-profile" aria-controls="pilot-profile" role="tab" data-toggle="tab"
                   class="bold"><?= $System->__('BODY_TEXT_PILOTPROFILE') ?></a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- STATS TAB -->
            <div role="tabpanel" class="tab-pane active" id="stats">
                <table>
                    <tr>
                        <th><?= $System->__('BODY_TEXT_STATS_PVPRANK') ?></th>
                        <th><?= $System->__('BODY_TEXT_STATS_GLOBALRANK') ?></th>
                    </tr>
                    <tr>
                        <td class="bold">--</td>
                        <td class="bold">#<?= $System->User->__get('RANKING') ?></td>
                    </tr>
                </table>
                <div id="level-progress" class="progress">
                    <span><?= $System->__('BODY_TEXT_STATS_LEVEL') ?> <?= $System->User->__get('LVL') ?></span>
                    <div class="progress-bar" role="progressbar"
                         style="width: <?= $System->User->getLevelProgress() ?>%;"></div>
                </div>
            </div> <!-- /stats -->

            <!-- EVENTS TAB -->
            <div role="tabpanel" class="tab-pane" id="events">

                    <table id="roster">
                        <tr id="event-days">
                            <th></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_SUNDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_MONDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_TUESDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_WEDNESDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_THURSDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_FRIDAY') ?></th>
                            <th><?= $System->__('BODY_TEXT_EVENTS_SATURDAY') ?></th>
                        </tr>
                        <tr data-time="0">
                            <th>00:00</th>
                            <td><?=$System->Game->getEventRunning(0,0) ?></td>
                            <td><?=$System->Game->getEventRunning(1,0) ?></td>
                            <td><?=$System->Game->getEventRunning(2,0) ?></td>
                            <td><?=$System->Game->getEventRunning(3,0) ?></td>
                            <td><?=$System->Game->getEventRunning(4,0) ?></td>
                            <td><?=$System->Game->getEventRunning(5,0) ?></td>
                            <td><?=$System->Game->getEventRunning(6,0) ?></td>
                        </tr>
                        <tr data-time="10">
                            <th>10:00</th>

                            <td><?=$System->Game->getEventRunning(0,1) ?></td>
                            <td><?=$System->Game->getEventRunning(1,1) ?></td>
                            <td><?=$System->Game->getEventRunning(2,1) ?></td>
                            <td><?=$System->Game->getEventRunning(3,1) ?></td>
                            <td><?=$System->Game->getEventRunning(4,1) ?></td>
                            <td><?=$System->Game->getEventRunning(5,1) ?></td>
                            <td><?=$System->Game->getEventRunning(6,1) ?></td>
                        </tr>
                        <tr data-time="14">
                            <th>14:00</th>

                            <td><?=$System->Game->getEventRunning(0,2) ?></td>
                            <td><?=$System->Game->getEventRunning(1,2) ?></td>
                            <td><?=$System->Game->getEventRunning(2,2) ?></td>
                            <td><?=$System->Game->getEventRunning(3,2) ?></td>
                            <td><?=$System->Game->getEventRunning(4,2) ?></td>
                            <td><?=$System->Game->getEventRunning(5,2) ?></td>
                            <td><?=$System->Game->getEventRunning(6,2) ?></td>
                        </tr>
                        <tr data-time="18">
                            <th>18:00</th>

                            <td><?=$System->Game->getEventRunning(0,3) ?></td>
                            <td><?=$System->Game->getEventRunning(1,3) ?></td>
                            <td><?=$System->Game->getEventRunning(2,3) ?></td>
                            <td><?=$System->Game->getEventRunning(3,3) ?></td>
                            <td><?=$System->Game->getEventRunning(4,3) ?></td>
                            <td><?=$System->Game->getEventRunning(5,3) ?></td>
                            <td><?=$System->Game->getEventRunning(6,3) ?></td>
                        </tr>
                        <tr data-time="22">
                            <th>22:00</th>

                            <td><?=$System->Game->getEventRunning(0,4) ?></td>
                            <td><?=$System->Game->getEventRunning(1,4) ?></td>
                            <td><?=$System->Game->getEventRunning(2,4) ?></td>
                            <td><?=$System->Game->getEventRunning(3,4) ?></td>
                            <td><?=$System->Game->getEventRunning(4,4) ?></td>
                            <td><?=$System->Game->getEventRunning(5,4) ?></td>
                            <td><?=$System->Game->getEventRunning(6,4) ?></td>
                        </tr>
                    </table>
            </div> <!-- /events -->

            <!-- PILOT PROFILE TAB -->
            <div role="tabpanel" class="tab-pane" id="pilot-profile">
                <div id="pilot-profile-user" class="tab-content">
                    <img alt='player_avatar'
                         src="<?= PROJECT_HTTP_ROOT ?>resources/images/avatars/default.png"
                         width="94"
                         height="94"
                         class="pull-left" />
                    <div id="pilot-profile-user-column1" class="pilot-profile-column">
                        <table>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_NAME') ?></th>
                                <td><?= $System->User->__get('PLAYER_NAME') ?></td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_SINCE') ?></th>
                                <td><?= $System->User->__get('REGISTERED') ?></td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_RANK') ?></th>
                                <td><?= $System->User->getRankName() ?></td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_TITLE') ?></th>
                                <td id="player-title"
                                    style="color: <?= $System->User->getTitleColor(
                                    ) ?> !important">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" disabled>No titles found
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Most Wanted</a></li>
                                            <li><a href="#">Lord Of Likes</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div> <!-- pilot-profile-user-column1 -->

                    <div id="pilot-profile-user-column2" class="pilot-profile-column">
                        <table>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_ORIGIN') ?></th>
                                <?php
                                $country = '- No Informations -';
                                $short = $System->User->__get('COUNTRY_NAME') != null ? $System->User->__get(
                                    'COUNTRY_NAME'
                                ) : '';
                                if ($short !== '') {
                                    $country = $countries[$short];
                                }
                                ?>
                                <td><?= $country ?></td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_AGE') ?></th>
                                <?php
                                $age = '- No Informations -';

                                if ($System->User->__get('BIRTHDATE')) {
                                    try {
                                        $today = new DateTime();
                                        $birthdate = new DateTime($System->User->__get('BIRTHDATE'));
                                        $interval = $today->diff($birthdate);
                                        $age = $interval->y;
                                    } catch (Exception $e) {
                                        // YOLO handling
                                    }
                                }

                                ?>
                                <td>
                                    <?= $age ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_GENDER') ?></th>
                                <?php
                                $gender = '- No Informations -';

                                if ($System->User->__get('GENDER') != 0) {
                                    if ($System->User->__get('GENDER') == 1) {
                                        $gender = 'Male';
                                    } else {
                                        if ($System->User->__get('GENDER') == 2) {
                                            $gender = 'Female';
                                        } else {
                                            $gender = 'Other';
                                        }
                                    }
                                }
                                ?>
                                <td>
                                    <?= $gender ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?= $System->__('BODY_TEXT_PP_CONTACT') ?></th>
                                <td><?=$System->User->__get('DISCORD_ID') != null ? $System->User->__get(
                                        'DISCORD_ID'
                                    ) : '- No Informations -'; ?></td>
                            </tr>
                        </table>
                    </div> <!-- pilot-profile-user-column2 -->
                </div> <!-- /pilot-profile-user -->

                <div id="pilot-profile-skills-text">
                    <a href="internalSkillTree" class="title"><?= $System->__('BODY_TEXT_PP_SKILLTREE') ?></a>
                </div>

                <div id="pilot-profile-skills" class="custom-scroll">

                </div> <!-- /pilot-profile-skills -->

            </div> <!-- /pilot-profile -->

        </div> <!-- /tab-content -->

    </div> <!-- /tabs-content -->
</div> <!-- /tabs-container -->

<div id="stats-corner">
    <div id="best-pilots" class="custom-scroll col-xs-6">
        <?= $System->User->createRankingList() ?>
    </div> <!-- /best-pilots -->

    <div id="logbook" class="col-xs-6">
        <!-- Yeah, it's a cool text bg bug it caused an annoying bug -->
        <!-- <div id="logbook-bg" class="bold">Logbook</div> -->

        <div id="logbook-entries" class="custom-scroll" dir="rtl">
            <?php
            $logs = $System->logging->getLogs(
                $System->User->__get('USER_ID'),
                $System->User->__get('PLAYER_ID'),
                $System->User->__get('SERVER_DB'),
                LogType::NORMAL
            );

            // if($System->User->USER_ID == 677) $System->User->fixDB();
            foreach ($logs as $log) {
                ?>
                <div class="log-entry">
                    <div class="log-entry-date bold"><?= $log['LOG_DATE'] ?></div>
                    <div class="log-entry-body"><?= $log['LOG_DESCRIPTION'] ?></div>
                </div>
                <?php
            }
            ?>
        </div> <!-- /logbook-entries -->
    </div> <!-- /logbook -->
</div> <!-- /stats-corner -->

    <script>
        $('#player-ship-box').mouseenter(function () {
            // Hides the player info box
            $('#player-info-profile').toggleClass('invisible');

            // Shows player name
            $('#player-info-name').toggleClass('invisible');

            // Hides the equipment box
            $('#player-info-equipment').toggleClass('invisible');
        }).mouseleave(function () {
            // Hides the player info box
            $('#player-info-profile').toggleClass('invisible');

            // Shows player name
            $('#player-info-name').toggleClass('invisible');

            // Hides the equipment box
            $('#player-info-equipment').toggleClass('invisible');
        });

        $('#player-title').mousedown(function () {
            //TODO: Find a way to implement a dropdown menu
            //$('#player-title').toggleClass('dropdown');
        });

        $('#news').click(function() {
            $('.tv-buttons').toggleClass('invisible');
            $('.tv-news').toggleClass('invisible');
        });

        function switchTvOn() {
            $('#tv-off').toggleClass('invisible');
            $('#tv-on').toggleClass('invisible');
        }

        let today = new Date().getHours();
        $('#roster .active-event').removeClass('active-event')
        if (today >= 22 && today <= 24) {
            $('#roster > tbody > tr[data-time="22"]').addClass('active-event')
        }
        else if (today >= 0 && today <= 2) {
            $('#roster > tbody > tr[data-time="0"]').addClass('active-event')
        }
        else if (today >= 10 && today <= 12) {
            $('#roster > tbody > tr[data-time="10"]').addClass('active-event')
        }
        else if (today >= 14 && today <= 16) {
            $('#roster > tbody > tr[data-time="14"]').addClass('active-event')
        }
        else if (today >= 18 && today <= 20) {
            $('#roster > tbody > tr[data-time="14"]').addClass('active-event')
        }
    </script>
