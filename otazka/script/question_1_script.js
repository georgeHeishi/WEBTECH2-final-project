let question = document.getElementById("question1");
let cnt_answers = document.getElementById("cnt-answers1");
let submit = document.getElementById("submit-question1");

cnt_answers.addEventListener("change",function (){
    let cnt = this.value;
    let target = document.getElementById("target1");
    target.innerHTML = "";
    for(let i =0; i < cnt; i++){
        let source =    "<label for="+i+"_question"+"></label>"+"<input type='text' class='answer1' id='"+i+"_answer1"+"'/></label>";
        target.innerHTML = target.innerHTML + source ;
    }

})



submit.addEventListener("click",function (){
    let answers = document.getElementsByClassName("answer1");
    let correct_answer = [];

    Array.from(answers).forEach(function (item,index){
        correct_answer.push(item.value);
    });

    let Json1 = {"question_type":"question_1","question":question.value,"correct":correct_answer};
    console.log(Json1);

})

