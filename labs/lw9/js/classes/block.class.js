var BlockElement = function(settings)
{
    this.id = settings.id;
    this.parentId = settings.parentId;
    this.prototype = settings.parent;
    this.imagesDir = settings.imagesDir;
    this.unclickedZoneId = 'un_clicked';
    this.blocksInLine = 3; // default settings
    this.blockLength = 150; // default settings
    this.moveDelay = 10;
    this.moveX = null;
    this.moveY = null;
    this.cursorStyle = 'pointer';
    this.zIndexStyle = 1;
    this.domElement = null;
    this.position =
    {
        x: null,
        y: null
    };

    this.init = function()
    {
        this.addDomElement();
        this.setPosition(this.id);
        this.moveToPosition();
        this.initCursor();
        if (settings.hasOwnProperty('blocksInLine')) this.blocksInLine = settings.blocksInLine;
        //if (settings.hasOwnProperty('blockLength')) this.blockLength = settings.blockLength;
    };

    this.setPosition = function(index)
    {
        this.position.x = ((index % this.blocksInLine) * this.blockLength) + 'px';
        this.position.y = (Math.floor(index / this.blocksInLine) * this.blockLength) + 'px';
    };

    this.getIndexByPos = function()
    {
        var index;
        index = Math.floor(parseInt(this.position.x) / this.blockLength);
        index += Math.floor(parseInt(this.position.y) / this.blockLength) * this.blocksInLine;
        return index;
    };

    this.moveToPosition = function()
    {
        this.domElement.style.left = this.position.x;
        this.domElement.style.top = this.position.y;
    };

    this.addDomElement = function()
    {
        var parent = document.getElementById(this.parentId);
        this.domElement = document.createElement('div');
        this.domElement.id = 'elt' + this.id;
        this.domElement.className = 'elt';
        this.domElement.classList = 'elt';
        this.domElement.style.backgroundImage = "url('img/game/" + this.imagesDir + this.id + ".png')";
        parent.appendChild(this.domElement);
        this.domElement.prototype = this;
    };

    this.clickHandler = function()
    {
        if (this.id != this.prototype.emptyBlockId)
        {
            if (this.checkHorizontal() || this.checkVertical())
            {
                this.switchPositions();
            }
        }
    };

    this.checkHorizontal = function()
    {
        var emptyBlock = this.prototype.elements[this.prototype.emptyBlockId];
        return ((this.blockLength == Math.abs(parseInt(this.domElement.style.left) - parseInt(emptyBlock.domElement.style.left)))
            && (this.domElement.style.top == emptyBlock.domElement.style.top));
    };

    this.checkVertical = function()
    {
        var emptyBlock = this.prototype.elements[this.prototype.emptyBlockId];
        return ((this.blockLength == Math.abs(parseInt(this.domElement.style.top) - parseInt(emptyBlock.domElement.style.top)))
            && (this.domElement.style.left == emptyBlock.domElement.style.left));
    };

    this.switchPositions = function()
    {
        var thisPtr = this;
        this.addUnClickedZone();
        this.initOffset();
        this.domElement.style.zIndex = this.zIndexStyle;
        this.moveInterval = setInterval(function(){ thisPtr.moveToEmptyBlockPosition() }, this.moveDelay);
    };

    this.addUnClickedZone = function()
    {
        document.getElementById(this.unclickedZoneId).style.display = 'block';
    };

    this.removeUnClickedZone = function()
    {
        document.getElementById(this.unclickedZoneId).style.display = 'none';
    };

    this.initOffset = function()
    {
        var emptyBlock = this.prototype.elements[this.prototype.emptyBlockId];
        this.moveX = parseInt(emptyBlock.domElement.style.left) - parseInt(this.domElement.style.left);
        this.moveX = this.moveX / Math.abs(this.moveX);
        this.moveY = parseInt(emptyBlock.domElement.style.top) - parseInt(this.domElement.style.top);
        this.moveY = this.moveY / Math.abs(this.moveY);
    };

    this.moveToEmptyBlockPosition = function()
    {
        var emptyBlock = this.prototype.elements[this.prototype.emptyBlockId];
        this.domElement.style.left = (parseInt(this.domElement.style.left) + this.moveX) + 'px';
        this.domElement.style.top = (parseInt(this.domElement.style.top) + this.moveY) + 'px';
        if (this.domElement.style.top == emptyBlock.domElement.style.top &&
            this.domElement.style.left == emptyBlock.domElement.style.left)
        {
            this.endMoving();
        }
    };

    this.endMoving = function()
    {
        var emptyBlock = this.prototype.elements[this.prototype.emptyBlockId];
        clearInterval(this.moveInterval);
        emptyBlock.domElement.style.left = this.position.x;
        emptyBlock.domElement.style.top = this.position.y;
        emptyBlock.position.x = this.position.x;
        emptyBlock.position.y = this.position.y;
        this.position.x = this.domElement.style.left;
        this.position.y = this.domElement.style.top;
        this.removeUnClickedZone();
        this.prototype.checkGameEnd();
    };

    this.initCursor = function()
    {
        if (this.id != this.prototype.emptyBlockId)
        {
            this.domElement.style.cursor = this.cursorStyle;
        }
    };

    this.addClickHandler = function()
    {
        var thisPtr = this;
        this.domElement.onclick = function(){ thisPtr.clickHandler(); };
    };

    this.init();
};