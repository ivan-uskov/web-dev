var FilesScoreHandler = function()
{
    var _plusButtonClass = 'change_score_plus';
    var _minusButtonClass = 'change_score_minus';
    var _fileIdClass = 'file_id';
    var _fileScoreClass = 'file_score';
    var _cantChangeMsg = "You can't change score more!";

    this._init = function()
    {
        this._initClickHandlers();
    };

    this._initClickHandlers = function()
    {
        var minusButtons = document.getElementsByClassName(_minusButtonClass);
        var plusButtons = document.getElementsByClassName(_plusButtonClass);
        for (var i = 0; i < plusButtons.length; i++)
        {
            plusButtons[i].onclick = this._clickHandler;
        }
        for (i = 0; i < minusButtons.length; i++)
        {
            minusButtons[i].onclick = this._clickHandler;
        }
    };

    this._clickHandler = function()
    {
        var fileId = _getCurrFileId.call(this);
        var howChange = null;
        if (this.className == _plusButtonClass)
        {
            howChange = true;
        }
        else if (this.className == _minusButtonClass)
        {
            howChange = false;
        }
         _changeFileScore.call(this, fileId, howChange);
    };

    function _changeFileScoreHTML(newScore)
    {
        if (newScore == '')
        {
            alert(_cantChangeMsg);
        }
        else
        {
            var trDomElt = this.parentElement.children;
            for (var elt = 0; elt < trDomElt.length; elt++)
            {
                if (trDomElt[elt].className == _fileScoreClass)
                {
                    trDomElt[elt].innerText = newScore;
                }
            }
        }

    }

    function _getCurrFileId()
    {
        var trDomElt = this.parentElement.children;
        for (var elt = 0; elt < trDomElt.length; elt++)
        {
            if (trDomElt[elt].className == _fileIdClass)
            {
                return trDomElt[elt].innerHTML;
            }
        }
        return false;
    }

    function _changeFileScore(fileId, isPlus)
    {
        var thisPtr = this;
        function onFileScoreChanged(xmlHttp)
        {
            if (xmlHttp.readyState == 4)
            {
                if (xmlHttp.status == 200)
                {
                    _changeFileScoreHTML.call(thisPtr, xmlHttp.responseText);
                }
            }
            return false;
        }
        var response = null;
        var xmlHttp = getXHR();
        xmlHttp.open('POST', 'change_score.php', true);
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlHttp.onreadystatechange = function()
        {
            onFileScoreChanged(xmlHttp);
        };
        var data = 'file_id=' + encodeURIComponent(fileId) + '&plus=' + encodeURIComponent(isPlus);
        xmlHttp.send(data);
        return response;
    };

    this._init();
};