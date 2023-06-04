const save_card_title = document.querySelector(".saveCardbtn");
let card_title = document.getElementById("card-title-getch");
let modal = document.querySelector(".modal");
const create_btn = document.querySelector('.create-btn');

save_card_title.addEventListener('click', () => {
    if(card_title.value == " "){
        modal.classList.toggle('d-none');
    }
})

create_btn.addEventListener("click", () =>{
    modal.classList.toggle('d-none');
})