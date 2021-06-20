var card_timer;
var card_selector, card_selector_1, card_selector_2, card_selector_3;
var art_card_1, art_card_2, art_card_3;

window.onload = function (){

    /* ---------------------- land cards -------------------- */

        card_selector_1 = document.getElementById("card_select_1");
        card_selector_2 = document.getElementById("card_select_2");
        card_selector_3 = document.getElementById("card_select_3");
        art_card_1 = document.getElementById("land-card-1");
        art_card_2 = document.getElementById("land-card-2");
        art_card_3 = document.getElementById("land-card-3");

        card_selector_1.style.color = "#CF698B";

        card_selector = 2;

        card_timer= setInterval(function (){
            if (window.innerWidth < 768){
                card_select(card_selector);
            } else{
                clearInterval(card_timer);
                card_selector_3.style.color = "#DEDEDE"; card_selector_2.style.color = "#DEDEDE";
                card_selector_1.style.color = "#CF698B";
                art_card_1.style.left = "0%";
                art_card_2.style.left = "100%";
                art_card_3.style.left = "200%";
            }
        }, 5000);

        document.getElementById("lon_in").onclick = function (){
            clearInterval(card_timer);
        };

        document.getElementById("sign_up").onclick = function (){
            clearInterval(card_timer);
        };
};

function card_select(card_s){
    switch (card_s){
        case 1: card_selector += 1;
                card_selector_3.style.color = "#DEDEDE"; card_selector_2.style.color = "#DEDEDE";
                card_selector_1.style.color = "#CF698B";
                art_card_1.style.left = "0%";
                art_card_2.style.left = "100%";
                art_card_3.style.left = "200%";
                break;
        case 2: card_selector += 1;
                card_selector_1.style.color = "#DEDEDE"; card_selector_3.style.color = "#DEDEDE";
                card_selector_2.style.color = "#CF698B";
                art_card_1.style.left = "-100%";
                art_card_2.style.left = "0%";
                art_card_3.style.left = "100%";
                break;
        case 3: card_selector = 1;
                card_selector_1.style.color = "#DEDEDE"; card_selector_2.style.color = "#DEDEDE";
                card_selector_3.style.color = "#CF698B";
                art_card_1.style.left = "-200%";
                art_card_2.style.left = "-100%";
                art_card_3.style.left = "0%";
                break;
    };
};


