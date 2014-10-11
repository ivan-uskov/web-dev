function getPos(index)
{
    var position =
    {
        'x': ((index % 3) * 150) + 'px',
        'y': (Math.floor(index / 3) * 150) + 'px'
    };
    return position;
}

for (var i = 0; i <= 8; i++)
{
    var field = document.getElementById('game_field');
    field.innerHTML += '<div class="elt" id="elt' + i + '">';
}

for (i = 0; i <= 8; i++)
{
    var elt = document.getElementById('elt' + i);
    elt.style.backgroundImage = "url('img/game/car/" + i + ".png')";
    elt.style.top = (Math.floor(i / 3) * 150) + 'px';
    elt.style.left = ((i % 3) * 150) + 'px';
}