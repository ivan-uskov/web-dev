/**
 * Устанавливает обрабочик на валидацию Input поля с id inputId
 * в стлачае некорректного заполнения делает контур родителя поля
 * делает красным и
 * и выводит соответсвующие сообщение если на уровень выше родителя
 * если элемент с классом error, у него устанавливается display: block;
 * @param inputId id нужного поля
 * @param exp выражение по которому будет проверка
 */
function validateField(inputId, exp)
{
    var msgDisplay = 'block';
    var errBorder = '1px solid #FF0000';
    var normBorder = '1px solid #089C02';

    var emailDomObj = document.getElementById(inputId);
    emailDomObj.__proto__ = this;
    var regexp = new RegExp(exp, 'i');

    function init()
    {
        emailDomObj.onblur = onBlurHandler;
    }

    function findErrBox()
    {
        var elements = emailDomObj.parentElement.parentElement.childNodes;
        for (var elt = 0; elt < elements.length; elt++)
        {
            if (elements[elt].hasOwnProperty('className') && (elements[elt].className == 'error'))
            {
                return elements[elt];
            }
        }
    }

    function checkEmail(email)
    {
        email = email.trim(); //удалям пробелы в конце и начале строки
        return regexp.test(email);
    }

    function onBlurHandler()
    {
        var errBox = findErrBox();
        if (!checkEmail(this.value))
        {
            this.parent.status = false;
            this.parentElement.style.border = errBorder;
            if (errBox !== undefined) errBox.style.display = msgDisplay;
        }
        else
        {
            this.parent.status = true;
            this.parentElement.style.border = normBorder;
            if (errBox !== undefined) errBox.style.display = 'none';
        }
    }

    init();
}

/**
 * При создании устанавливает обработчик на форму
 * @param fields
 * fields.key = val
 * key - id поля vak тип проверки
 * val = email проверка на валидность email
 * val = pass проверка на валидность пароля
 * val = text проверка на отсутствие недопустимых символов
 * в текст обычно имя и фамилия
 *
 */
function ValidateForm(fields)
{
    var emailRule = '^([\\w\\-]+\\.)*[\\w\\-]+@([a-z0-9][a-z0-9\\-]*[a-z0-9]\\.)+[a-z]{2,4}$';
    var textRule = '^[a-zA-Z]+[\\.\\w\\-\\s]*$';
    var passRule = '^([a-zA-Z0-9]{6,})+$';
    this.status = null;

    var key;
    var currRule;
    for(key in fields) if (fields.hasOwnProperty(key))
    {
        if (fields[key] == 'email') currRule = emailRule;
        else if(fields[key] == 'pass') currRule = passRule;
        else if(fields[key] == 'text') currRule = textRule;
        else continue;
        this[key + 'Validator'] = new validateField(key, currRule);
        this[key + 'Validator'].parent = this;
    }
}