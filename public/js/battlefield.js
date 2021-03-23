
const battleField = document.querySelectorAll('.field')
const message = document.querySelector('.message')
const button = document.querySelector('.newgame')

button.addEventListener('click', async ()=>{
    const url = 'http://battleships.ivoiliev.tk/api/newgame';
   
        const response =  await fetch(url)
                .then(response => {
                   !response.ok? message.innerText = 'Грешка няма връзка със сървъра : '+ response.status: location.reload()
        })
 

})


battleField.forEach((field) => {
    field.addEventListener('click', async () => {
        const cordinates = field.getAttribute("cordinates")
        const y = cordinates.slice(1)
        const x = cordinates.slice(0, 1)
        const squareState = field.innerText

        const result = await shot(x, y, squareState)

        field.innerText = result.squareState
        message.innerText = result.message


    });
});

const  shot = async (x, y, squareState) => {
    let message = ''

    if (squareState == 'X' || squareState == "-") {
        message = 'Вече си стрелял по: ' + x + y
    } else {
        let response=  await checkTheShot(x,y)
        if(typeof(response) == "undefined"){
            message = 'Грешка няма връзка със сървъра ';
            squareState = '.';
        } else {
        
        if(response.message =='X'){
            message = 'Попадение на :' + x + y;
            squareState = 'X';
        }else if(response.message =='.'){
            message = 'Пропусна на: ' + x + y ;
            squareState = '-';
        } else if(response.message =='-'){
            message = 'Пропусна на: ' + x + y ;
            squareState = '-';
        }
        
        if(response.win){message = 'Победа. Всички кораби са потопени.'}
    }
        
        
    }

    return {'squareState': squareState, 'message': message}
}

// Make shot to Laravel API 

const checkTheShot = async (x,y) => {
    
    const url = 'http://battleships.ivoiliev.tk/api/shot';
    const forSending = {
        'x': x,
        'y': y
    }
    const options = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(forSending)
    }
    try{
    const response = await fetch(url,options);
    const result = await response.json();
    return  result 
    } catch(err){}
    
}
