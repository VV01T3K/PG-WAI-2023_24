const button = document.querySelector("#save");

function add_favs() {
    const favs = document.querySelectorAll('[name="fav"]:checked');
    const favsArray = [...favs];
    const favsIds = favsArray.map((fav) => fav.value);
    const favsJSON = JSON.stringify(favsIds);
    return favsJSON;
}

function delete_favs() {
    const favs = document.querySelectorAll('[name="fav"]:checked');
    const favsArray = [...favs];
    const favsIds = favsArray.map((fav) => fav.value);
    const favsJSON = JSON.stringify(favsIds);

    document.querySelectorAll('.image:has([name="fav"]:checked)').forEach((e) => e.remove());

    return favsJSON;
}
