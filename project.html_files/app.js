$(document).ready(function() {
    
    var obj_kari = document.getElementById('dispStartDate').placeholder;
   var disDate = new Date(obj_kari);
   var dispYear = disDate.getFullYear() + "年" + (disDate.getMonth() + 1)  + "月";
   document.getElementById('topic-disp-month').value = dispYear;

    /**
     * バーガーメニュー展開
     */
    var burger = $('.burger');
    var menu = $('#' + burger.data('target'));
    burger.on('click', function() {
        burger.toggleClass('is-active');
        menu.toggleClass('is-active');
    });

    /**
     * 操作パネル展開
     */
    var panel_button = $('.panel_button');
    var panel = $('#panel');
    panel_button.on('click', function() {
        panel.toggleClass('is-hidden');
    });

    /**
     * 汎用モーダル表示制御
     * 
     * 参考
     * https://blog.narito.ninja/detail/131
     */
    for (const element of document.querySelectorAll('.modal .close-modal, .show-modal')) {
        element.addEventListener('click', e => {
            const modalId = element.dataset.target;
            const modal = document.getElementById(modalId);
            modal.classList.toggle('is-active');
        });
    }
  
    /*テンプレートのダイアローグを表示*/
    $("#saveTemplate").on("click",function(){
     document.getElementById('dialog-template').show();
    });
    
     /*休日設定のダイアローグを表示*/
    $("#set_holiday").on("click",function(){
     document.getElementById('dialog-holiday').show();
    });

    /**
     * テーブルクリックで色を付ける
     */
    $("#data_table tr").on("click",function(){
        if ($(this).hasClass("is-selected")) {
            $(this).removeClass("is-selected");
        } else {
            $(this).addClass("is-selected");
        }
    });
var txt = "";
    /**
     * リストの情報取得
     */
    $("#data_list tbody tr").on("click",function(){
        var text = $(this).children().text().trim();
        console.log(text);
        txt = text;
        $("#edit_area").val(text);
    });

    $.contextMenu({
        selector: '#data_list tbody', 
        callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m + txt); 
        },
        items: {
            "edit": {name: "Edit", icon: "edit"},
            "cut": {name: "Cut", icon: "cut"},
            copy: {name: "Copy", icon: "copy"},
            "paste": {name: "Paste", icon: "paste"},
            "delete": {name: "Delete", icon: "delete"},
            "sep1": "---------",
            "quit": {name: "Quit", icon: function(){
                return 'context-menu-icon context-menu-icon-quit';
            }}
        }
    });
    
    $.contextMenu({
        selector: '#clientList #data_table tbody th',
        callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m + txt);
        },
        items: {
            "edit": {name: "Edit", icon: "edit"},
            "cut": {name: "Cut", icon: "cut"},
            copy: {name: "Copy", icon: "copy"},
            "paste": {name: "Paste", icon: "paste"},
            "delete": {name: "Delete", icon: "delete"},
            "sep1": "---------",
            "quit": {name: "Quit", icon: function(){
                return 'context-menu-icon context-menu-icon-quit';
            }}
        }
    });

    $('.context-menu-one').on('click', function(e){
        console.log('clicked', this);
    })    
});
