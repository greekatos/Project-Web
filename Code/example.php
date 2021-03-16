<!DOCTYPE html>
<html>
<body>
    <p>Select one or more checkboxes and click the button!</p>

    <div id="birds">
        <input type="checkbox" id="brd1" value="Mourning Dove" />
        <label for="brd1">Mourning Dove</label>
        <br />
        <input type="checkbox" id="brd2" value="Rock Pigeon" />
        <label for="brd2">Rock Pigeon</label>
        <br />
        <input type="checkbox" id="brd3" value="Black Vulture" />
        <label for="brd3">Black Vulture</label>
		<br />
		<input type="checkbox" id="brd4" value="EEEE Vulture" />
        <label for="brd4">EEEE Vulture</label>
    </div>
    <p>
        <input type="button" id="check" onclick="nowCheck()" value="Click it" />
    </p>
</body>
<script>
    function nowCheck() {
        // Get all the child elements inside the DIV.
        var cont = document.getElementById('birds').children;  

        for (var i = 0; i < cont.length; i++) {
            // Check if the element is a checkbox.
            if (cont[i].tagName == 'INPUT' && cont[i].type == 'checkbox') {
                // Finally, check if the checkbox is checked.
                if (cont[i].checked) {
                    alert(cont[i].value + ' is checked!');
                }
            }
        }
    }
</script>
</html>