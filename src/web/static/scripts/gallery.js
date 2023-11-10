//
const button = document.querySelector("#save");

function favs() {
    const favs = document.querySelectorAll('[name="fav"]:checked');
    const favsArray = [...favs];
    const favsIds = favsArray.map((fav) => fav.value);
    const favsJSON = JSON.stringify(favsIds);
    return favsJSON;
}
