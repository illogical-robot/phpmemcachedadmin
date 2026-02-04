<?php
use App\Library\Data\Errors;

# Server seems down
if ((isset($stats)) && (($stats === false) || ($stats == []))) : ?>
    <div class="header corner full-size padding" style="margin-top:10px;text-align:center;">
        <?php if (isset($_REQUEST['server'])) : # Asking server of cluster stats ?>
            <?php if ($_ini->cluster($_REQUEST['server'])) : ?>
                <?= htmlspecialchars('All servers from Cluster ' . $_REQUEST['server']) ?>
            <?php else : ?>
                <?= htmlspecialchars("Server {$_REQUEST['server']} did not respond!") ?>
            <?php endif ?>
        <?php else : # All servers stats ?>
            Servers did not respond!
        <?php endif ?>
    </div>
    <div class="container corner full-size padding">
        <span class="left">Error message</span>
        <br/>
        <?php echo htmlspecialchars(Errors::last()); ?>
        <br/>
        <br/>
        Please check above error message or your server status and retry
    </div>
<?php elseif((isset($slabs)) && ($slabs === false)) : # No slabs used ?>
    <div class="header corner full-size padding" style="margin-top:10px;text-align:center;">
        No slabs used in this server !
    </div>
    <div class="container corner full-size padding">
        <span class="left">Error message</span>
        <br/>
        Maybe this server is not used, check your server status and retry
    </div>
<?php elseif((isset($items)) && ($items === false)) : # No Items in slab ?>
    <div class="header corner full-size padding" style="margin-top:10px;text-align:center;">
        No item in this slab !
    </div>
    <div class="container corner full-size padding">
        <span class="left">Error message</span>
        <br/>
        This slab is allocated, but is empty
        <br/>
        <br/>
        Go back to <a href="?server=<?php echo urlencode($_REQUEST['server']); ?>&amp;show=slabs" class="green">Server Slabs</a>
    </div>
<?php endif;
