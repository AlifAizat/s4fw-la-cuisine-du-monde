
var count_i;
var count_recipe;


document.getElementById("clickAddIngredientInput").onclick = function () {


    if(count_i == undefined){
        count_i = 2;
    }else {
        count_i ++;
    }

    var newDivCol = document.createElement("div");
    newDivCol.setAttribute("class","col-md-4");
    //second div
    var newDivForm = document.createElement("div");
    newDivForm.setAttribute("class","form-group label-floating");
    newDivCol.appendChild(newDivForm);

    //label
    var newLabelKBD = document.createElement("kbd");
    newLabelKBD.innerHTML = "Ingrédient "+count_i;

    var newlabel = document.createElement("label");
    newlabel.setAttribute("class","control-label");
    newlabel.appendChild(newLabelKBD);
    newDivForm.appendChild(newlabel);

    //input
    var newInput = document.createElement("input");
    newInput.setAttribute("type","text");
    newInput.setAttribute("class","form-control _inputLabel");
    newInput.setAttribute("v-model","ingredient");
    newInput.setAttribute("id","ingredient_"+count_i);

    newDivForm.appendChild(newInput);

    var element = document.getElementById("addRowsIngredient");
    element.appendChild(newDivCol);
};

document.getElementById("clickAddRecipeInput").onclick = function () {


    if(count_recipe == undefined){
        count_recipe = 2;
    }else {
        count_recipe ++;
    }

    var newDivCol = document.createElement("div");
    newDivCol.setAttribute("class","col-md-4");
    //second div
    var newDivForm = document.createElement("div");
    newDivForm.setAttribute("class","form-group label-floating");
    newDivCol.appendChild(newDivForm);

    //label
    var newLabelKBD = document.createElement("kbd");
        newLabelKBD.innerHTML = "Étape "+count_recipe;

    var newlabel = document.createElement("label");
    newlabel.setAttribute("class","control-label");
    newlabel.appendChild(newLabelKBD);
    newDivForm.appendChild(newlabel);

    //input
    var newInput = document.createElement("input");
    newInput.setAttribute("type","text");
    newInput.setAttribute("class","form-control _inputLabel");
    newInput.setAttribute("v-model","ingredient");
    newInput.setAttribute("id","etape_"+count_recipe);
    newDivForm.appendChild(newInput);

    var element = document.getElementById("addRowsRecipe");
    element.appendChild(newDivCol);
};

document.getElementById("newCuisine_button_grouping").onclick = function (e) {


    if (count_i == undefined)
    {
        count_i = 1;
    }

    if (count_recipe == undefined)
    {
        count_recipe = 1;
    }
    let ingredient_id = 'ingredient_';
    let recipe_id = 'etape_';

    var x,y;
    var ingredients_buff = "";
    var recipe_buff = "";
    var string = "hello";

    for (x= 1; x <= count_i; x++)
    {

        ingredients_buff = ingredients_buff.concat(document.getElementById(ingredient_id + x).value + '|');
    }

    for (y=1; y <= count_recipe; y++)
    {
        recipe_buff = recipe_buff.concat(document.getElementById(recipe_id + y).value + '|');
    }

    var ingredients = document.getElementById('cuisine_ingredients');
    var recipe = document.getElementById('cuisine_recipe');

    ingredients.setAttribute('value', ingredients_buff);
    recipe.setAttribute('value', recipe_buff);

    document.getElementById('newCuisine_button_form').click();

}

function readImageURL(input) {

    if (input.files && input.files[0])
    {
        var file_reader = new FileReader();

        file_reader.onload = function (e) {
            $('#img_input')
                .attr('src', e.target.result)
                .css('max-height','300px')

        };

        file_reader.readAsDataURL(input.files[0]);
    }

}