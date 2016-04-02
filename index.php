<?php
/**
 * Created by PhpStorm.
 * User: Artmadiar
 * Date: 28.02.2016
 * Time: 7:52
 */

include("administration/header.php");

echo '<?xml version="1.0" encoding="utf-8"?>
<svg style="width:60%;" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 595.3 466.3" style="enable-background:new 0 0 595.3 466.3;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#DFE0E0;}
    .st1{fill:#76B76A;}
    .st2{fill:#f0f0f0;}
</style>
    <path class="st0" d="M451.9,433.1L593,231.6c0,0-195.5-350.7-372.9-181.4s-332.6,219.7-98.8,350.7s-8.8-177.4,152.8-215.7
s-29.1,105.1,99.1,141.1s-28.2,40.3,14.1,106.8S451.9,433.1,451.9,433.1z"/>
    <path class="st1" d="M113.6,183.3c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S126.7,170.2,113.6,183.3z"/>
    <path class="st1" d="M47.8,259.7c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0s0-36,0-36S61,246.6,47.8,259.7z"/>
    <path class="st1" d="M186.6,112.6c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S199.7,99.5,186.6,112.6z"/>
    <path class="st1" d="M122.5,322.8c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S135.7,309.6,122.5,322.8z"/>
    <path class="st1" d="M255.1,52c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0s0-36,0-36S268.2,38.8,255.1,52z"/>
    <path class="st1" d="M349.5,52c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S362.6,38.8,349.5,52z"/>
    <path class="st1" d="M423.7,106.4c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S436.8,93.2,423.7,106.4z"/>
    <path class="st1" d="M484.3,173.3c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S497.4,160.2,484.3,173.3z"/>
    <path class="st1" d="M397.6,203.3c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S410.7,190.2,397.6,203.3z"/>
    <path class="st1" d="M464.2,267.4c-23.6,23.6,0,43.8,0,43.8s17.4,14,31.5,0c14-14,0-36,0-36S477.3,254.3,464.2,267.4z"/>
</svg>';

include("administration/footer.php");


echo '
<script src="'.$rel_path.'js/jquery.contextmenu.r2.packed.js"></script>';

echo ' <div class="contextMenu" id="myMenu3">

    <ul>

      <li id="item_1" onclick="sel_el();" >Item 1</li>
      <li id="item_2" onclick="sel_el();" >Item 2</li>
      <li id="item_3" onclick="sel_el();" >Item 3</li>

    </ul>

  </div>';

echo '<script>

    function sel_el(){
        $("body").click();
    }

     $(".st1").contextMenu("myMenu3", {

      onContextMenu: function(e) {
         if (window.s!=undefined)
         window.s.classList.remove("st2");
         window.s = e.toElement;
         window.s.classList.add("st2");
         return true;
      },
      onShowMenu: function(e, menu) {
        if ($(e.target).attr("id") == "showOne") {
            $("#item_2, #item_3", menu).remove();
        }
        return menu;
      }

    });

</script>
';