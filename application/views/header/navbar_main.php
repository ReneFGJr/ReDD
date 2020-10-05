<?php
$paths = 'index.php/main/';
?>
<nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav">
        <li>
            <img src="https://www.ufrgs.br/redd/img/logo/logo_redd_25.png" class="nav-link">
        </li>
        <li class="active">
            <a href="<?php echo base_url($paths); ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item" style="margin-left: 20px;">
            <a href="<?php echo base_url($paths . 'about'); ?>" class="nav-link">Sobre</a>
        </li>
        <li class="nav-item" style="margin-left: 20px;">
            <a href="<?php echo base_url($paths . 'contact'); ?>" class="nav-link">Contato</a>
        </li>
        <li class="nav-item" style="margin-left: 20px;">
            <a href="<?php echo base_url($paths . 'services'); ?>" class="nav-link">Serviços</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">

        <li class="nav-item text-right">
            <?php
            $socials = new socials;
            echo $socials->menu_user();
            ?>
        </li>
    </ul>
    </div>
</nav>

<style>
    .nav-item::after {
        content: '';
        display: block;
        width: 0px;
        height: 4px;
        background: #ff0000;
        transition: 0.2s;
        margin-top: -10px;
    }

    .nav-item:hover::after {
        width: 100%;
    }


    .nav-link {
        padding: 15px 5px;
        transition: 0.2s;
    }

    .navbar-nav .nav-link {

        color: #000;
        font-weight: bold;
        font-size: 18px;
    }

    .navbar-nav .active>.nav-link {

        width: 100%;
        height: 51px;

        border-bottom: .25rem solid transparent;
        border-bottom-color: #ed4137;

    }
</style>