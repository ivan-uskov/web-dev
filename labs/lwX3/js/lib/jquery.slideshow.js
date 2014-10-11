JQuerySlideShow = function(params)
{
    /* Start Variables and Settings */

    this.imageVendorPath = params.imageVendorPath;
    this.container =
    {
        id: null,
        jObject: null,
        css :
        {
            width: null,
            height: null
        },
        slides:
        {
            name: "slides_container",
            jObject: null,
            intervals: [],
            moveDelay: 1, //0.0001 мс
            slideShowInterval: 5000,
            speed: 1 //px
        },
        buttons:
        {
            rightButtonAttrs:
            {
                id: 'rightNavButton',
                class: 'rightNavButton'
            },
            leftButtonAttrs:
            {
                id: 'leftNavButton',
                class: 'leftNavButton'
            },
            idPosfix: 'NavButton',
            widthCoef: 3.5
        }
    };

    this._imgAlt = 'Картинка временно отсутствует';
    this._gallery = [];
    this._currElement = 0; //currentImageIndex
    this._nextElement = null;
    this._newImages = [];
    this._imagesPartSize = 10;
    this._imagesUntilNewUpload = 5;
    this._start = true;

    /* End Variables and Settings */

    this._constructor = function()
    {
        this._initParams();
        this._buildHtmlContext();
        this._addImages();
    };

    this._initParams = function()
    {
        this.container.id = params.containerID;
        this.container.jObject = $('#' + params.containerID);
        this.container.css.width = this.container.jObject.css('width');
        this.container.css.height = this.container.jObject.css('height');
    };

    /* Start Html Methods */

    this._buildHtmlContext = function()
    {
        this._addContainer();
        this._addButtons();
    };

    this._addContainer = function()
    {
        var slidesContainerAttrs =

        {
            id: this.container.slides.name,
            class: this.container.slides.name
        };
        this.container.jObject.append(this._getHtmlOptionText('div', slidesContainerAttrs, false));
        this.container.slides.jObject = $('#' + this.container.slides.name);
        this.container.slides.jObject.css(this.container.css);
    };

    this._addButtons = function()
    {
        var container = this.container;
        var buttonsText = this._getHtmlOptionText('div', container.buttons.leftButtonAttrs, false) +
                          this._getHtmlOptionText('div', container.buttons.rightButtonAttrs, false);

        container.slides.jObject.append(buttonsText);
        this._setButtonsWidth();
        this._initButtonsHandlers();
    };

    this._setButtonsWidth = function()
    {
        var container = this.container;
        var containerWidth = parseInt(container.slides.jObject.css('width'));
        var buttonsWidth = (containerWidth / this.container.buttons.widthCoef ) + 'px';
        container.slides.jObject.find('div').each(function()
        {
            $(this).css('width', buttonsWidth);
        });
    };

    this._getHtmlOptionText = function(tag, attrs, isShort)
    {
        var htmlOptionText = '<' + tag;
        for (var key in attrs)
        {
            if (attrs.hasOwnProperty(key))
            {
                htmlOptionText += ' ' + key + '="' + attrs[key] + '"'
            }
        }
        htmlOptionText += isShort ? ' />' : '></' + tag + '>';
        return htmlOptionText;
    };

    /* End Html Methods */

    this._initButtonsHandlers = function()
    {
        var thisPtr = this;
        var container = this.container;
        $('#' + container.buttons.rightButtonAttrs.id).click(function()
        {
            thisPtr._checkNeedUploadImages();
            thisPtr._switchSlide(false);
        });
        $('#' + container.buttons.leftButtonAttrs.id).click(function()
        {
            thisPtr._checkNeedUploadImages();
            thisPtr._switchSlide(true);
        });
    };

    this._checkNeedUploadImages = function()
    {
        var isNeedUpload = this._gallery.length - this._currElement <= this._imagesUntilNewUpload ||
                           this._currElement == this._gallery.length - 1;
        if (isNeedUpload)
        {
            this._addImages();
        }
    };

    this._switchSlide = function(isLeft)
    {
        if (this._nextElement == null)
        {
            this._nextElement = this._getNewSlideId(isLeft);
            this._prepareNewSlide(this._nextElement, isLeft);
            this._moveSlide(this._nextElement, isLeft, true);
            this._moveSlide(this._currElement, isLeft, false);
        }
    };

    this._addAutoSlide = function()
    {
        var thisPtr = this;
        function autoSlide()
        {
            thisPtr._checkNeedUploadImages();
            thisPtr._switchSlide(true);
        }
        setInterval(function(){ autoSlide(); }, this.container.slides.slideShowInterval);
    };

    this._getNewSlideId = function(isLeft)
    {
        var newId = null;
        if (isLeft)
        {
            newId = this._currElement + 1;
            newId =  (this._gallery[newId] != undefined) ? newId : 0;
        }
        else
        {
            newId = this._currElement - 1;
            newId =  (this._gallery[newId] != undefined) ? newId : this._gallery.length - 1;
        }
        return newId;
    };

    this._prepareNewSlide = function(newSlideId, isLeft)
    {
        var containerWidth = parseInt(this.container.jObject.css('width'));
        var newLeftVal = isLeft ? containerWidth : -containerWidth;
        var newSlide = $('#' + newSlideId);
        newSlide.show();
        newSlide.css('left', newLeftVal);
    };

    this._moveSlide = function(slideId, isLeft, isNewElt)
    {
        function moveSlideOnes(slideId)
        {
            var oldLeft = parseInt(slideObj.css('left'));
            var newLeft = isLeft ? oldLeft - slides.speed : oldLeft + slides.speed;
            slideObj.css('left', newLeft);
            motion -= slides.speed;
            if (motion <= 0)
            {
                thisPtr._clearSlideInterval(slideId, isNewElt, !isNewElt);
            }
        }
        var thisPtr = this;
        var slides = this.container.slides;
        var slideObj = $('#' + slideId);
        var motion = parseInt(this.container.jObject.css('width'));
        slides.intervals[slideId] = setInterval(function(){ moveSlideOnes(slideId) }, slides.moveDelay);
    };

    this._clearSlideInterval = function(slideId, isNewCurr, isHide)
    {
        clearInterval(this.container.slides.intervals[slideId]);
        this._nextElement = null;
        if (isNewCurr)
        {
            this._currElement = slideId
        }
        if (isHide)
        {
            $('#' + slideId).hide();
        }
    };

    this._addNewImages = function()
    {
        var paths = this._newImages;
        for (var i = 0; i < paths.length; i++)
        {
            var attrs =
            {
                src: paths[i],
                alt: this._imgAlt,
                id: this._gallery.length
            };
            var imgTagStr = this._getHtmlOptionText('img', attrs, true);
            this.container.slides.jObject.append(imgTagStr);
            $('#' + this._gallery.length).hide();
            this._gallery.push(paths[i]);
        }
    };

    this._initUploadedImages = function()
    {
        var images = $('.' + this.container.slides.name + ' > img');
        images.each(function(){
            $(this).hide();
        });
        $('#' + this._currElement).show();
    };

    this._addImages = function()
    {
        var thisPtr = this;
        function onResponse( response )
        {
            thisPtr._newImages = JSON.parse(response);
            thisPtr._addNewImages();
            if (thisPtr._start)
            {
                thisPtr._initUploadedImages();
                thisPtr._addAutoSlide();
            }
            thisPtr._start = false;
        }
        $.post(this.imageVendorPath, { index: this._gallery.length, size: this._imagesPartSize }, "json").done(onResponse);
    };

    this._constructor();
};