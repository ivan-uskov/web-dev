var GameField = function(containerId)
{
    this.blocksInLine = 3;
    this.blocksInGame = 9;
    this.emptyBlockId = 6;
    this.blockLength = null;
    this.container = null;
    this.containerLength = null;
    this.elements = [];
    this.settings =
    {
        imagesDir: 'car/',
        blocksInLine: this.blocksInLine,
        parentId: 'game_field',
        parent: this
    };

    this.init = function(containerId)
    {
        this.container = document.getElementById(containerId);
        this.containerLength = this.setContainerLength();
        this.blockLength = Math.floor(this.containerLength / this.blocksInLine);
        this.settings.blockLength = this.blockLength;
        this.initElementsInGame();
    };

    this.setContainerLength = function()
    {
        if (this.container.style.width >= this.container.style.height)
        {
            return this.container.style.height;
        }
        else
        {
            return this.container.style.width;
        }
    };

    this.checkGameEnd = function()
    {
        var gameEnd = true;
        for (var elt = 0; elt < this.blocksInGame; elt++)
        {
            if ((this.elements[elt].id != this.emptyBlockId))
            {
                 gameEnd = gameEnd && (this.elements[elt].id == this.elements[elt].getIndexByPos());
            }
        }
        if (gameEnd)
        {
            if(confirm('You Win!\nTry Again?'))
            {
                this.jumble();
            }
        }
    };

    this.jumble = function()
    {
        for (var elt = 0; elt < this.blocksInGame; elt ++)
        {
            var randEltId = Math.round(0.5 + Math.random()*(this.blocksInGame));
            if ((elt != this.emptyBlockId) && (randEltId != this.emptyBlockId) && elt != randEltId)
            {
                this.switchElements(elt, randEltId);
            }
        }
    };

    this.switchElements = function(elt1, elt2)
    {
        var buffer = this.elements[elt1].position.x;
        this.elements[elt1].position.x = this.elements[elt2].position.x;
        this.elements[elt2].position.x = buffer;
        buffer = this.elements[elt1].position.y;
        this.elements[elt1].position.y = this.elements[elt2].position.y;
        this.elements[elt2].position.y = buffer;
        this.elements[elt1].moveToPosition();
        this.elements[elt2].moveToPosition();
    };

    this.initElementsInGame = function()
    {
        for (this.settings.id = 0; this.settings.id < this.blocksInGame; this.settings.id++)
        {
            this.elements[this.settings.id] = new BlockElement(this.settings);
            this.elements[this.settings.id].addClickHandler();
        }
        this.addNewGameButtonHandler();
    };

    this.addNewGameButtonHandler = function()
    {
        var thisPtr = this;
        var newGame = document.getElementById('reset');
        newGame.onclick = function() { thisPtr.jumble() };
    };

    this.init(containerId);
};