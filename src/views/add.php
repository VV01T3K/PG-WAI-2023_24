<h1>Test of inserting to db</h1>

<form hx-post="/add" hx-target="#comm" hx-swap="innerHTML">
    <input type="text" name="name" placeholder="name">
    <input type="text" name="price" placeholder="price">
    <input type="text" name="description" placeholder="description">
    <button>Try</button>
</form>

<p id="comm">
    komunikat
</p>