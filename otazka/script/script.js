let question = document.getElementById("question");
let cnt_answers = document.getElementById("cnt-answers");
let submit = document.getElementById("submit-question");

cnt_answers.addEventListener("change",function (){
    let cnt = this.value;
    let target = document.getElementById("target");
    target.innerHTML = "";
    for(let i =0; i < cnt; i++){
        let source =    "<label for="+i+"_question"+"></label>"+"<input type='text' class='answer' id='"+i+"_answer"+"'/></label>"+
                        "<label for="+i+"_correct"+" ></label>"+"<input type='radio' class='correct' id='"+i+"_correct"+"'/></label>";

        target.innerHTML = target.innerHTML + source ;
    }

    let radios = document.getElementsByTagName('input');
    for(let i=0; i<radios.length; i++ ) {
        radios[i].onclick = function(e) {
            if(e.ctrlKey || e.metaKey) {
                this.checked = false;
            }
        }
    }
})

submit.addEventListener("click",function (){
    let answers = document.getElementsByClassName("answer");
    let correct_answer_element = document.getElementsByClassName("correct");

    let correct_answer = [];
    let incorrect_answer =[];

    Array.from(answers).forEach(function (item,index){
        let id_answer = item.id.split("_");
        let id_correct = Array.from(correct_answer_element)[index].id.split("_");

        if((id_answer[0] === id_correct[0]) && Array.from(correct_answer_element)[index].checked=== true){
            correct_answer.push(item.value);
        }else{
            incorrect_answer.push(item.value);
        }
    });

    let Json = {"question_type":"question_2","question":question.value,"correct":correct_answer,"incorrect":incorrect_answer};
})