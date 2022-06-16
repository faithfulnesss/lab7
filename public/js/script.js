
const typingText = document.querySelector(".typing-text p"),
    inpField = document.querySelector(".wrapper .input-field"),
    tryAgainBtn = document.querySelector(".content button"),
    timeTag = document.querySelector(".time span b"),
    mistakeTag = document.querySelector(".mistakes span"),
    wpmTag = document.querySelector(".wpm span"),
    cpmTag = document.querySelector(".cpm span");


let timer,
    maxTime = 30,
    timeLeft = maxTime,
    charIndex = mistakes = isTyping = missed = wpm = 0;
let spaces = [];

function* time_loop(arr) {
    let i = 0
    let length = arr.length
    while(true) {
        yield arr[i]
        i++
        if(i === length) i = 0
    }
}

let time_element = document.querySelector('.time span b');

const gen = time_loop([30, 45, 60, 15]);

time_element.innerHTML = gen.next().value

time_element.addEventListener('click', () => {
    if(!isTyping){
        time_element.innerHTML = gen.next().value;
        maxTime = time_element.innerHTML;
        timeLeft = maxTime;
    }
})

function addWords(quantity) {
    for (let idx = 0; idx < quantity; idx++) {
        let word = paragraphs[Math.floor(Math.random() * paragraphs.length)]
        word.split("").forEach(character => typingText.innerHTML += `<span>${character}</span>`)
        typingText.innerHTML += '<span> </span>';
    }
}


function loadParagraph() {
    typingText.innerHTML = "";
    addWords(40);
    typingText.querySelectorAll("span")[0].classList.add("active");
    document.addEventListener("keydown", () => inpField.focus());
    typingText.addEventListener("click", () => inpField.focus());
}

function initTyping() {
    let characters = Array.from(typingText.querySelectorAll("span"));
    let typedChar = inpField.value.split("")[charIndex];
    if (charIndex < characters.length - 1 && timeLeft > 0) {
        if (!isTyping) {
            timer = setInterval(initTimer, 1000);
            isTyping = true;
        }
        if (typedChar == null) {
            if (charIndex > 0) {
                charIndex--;
                if (characters[charIndex].classList.contains("incorrect")) {
                    mistakes--;
                }
                characters[charIndex].classList.remove("correct", "incorrect");
            }
        } else {
            if (characters[charIndex].innerText == typedChar) {
                characters[charIndex].classList.add("correct");
                if (typedChar === ' ') {
                    spaces.push(charIndex);
                }
            } else {
                mistakes++;
                missed++;
                characters[charIndex].classList.add("incorrect");
            }
            charIndex++;
        }

        if (spaces.length % 10 === 0 && spaces.length > 9) {
            characters.slice(0, spaces[0]).forEach((element) => element.style.display = 'none');
            characters.slice(spaces[0], spaces[9]).forEach((element) => element.style.display = 'none');
            spaces.splice(0, 9);
            addWords(10);
        }


        characters.forEach(span => span.classList.remove("active"));
        characters[charIndex].classList.add("active");

        let wpm = Math.round(((charIndex - mistakes) / 5) / (maxTime - timeLeft) * 60);
        wpm = wpm < 0 || !wpm || wpm === Infinity ? 0 : wpm;

        wpmTag.innerText = wpm;
        mistakeTag.innerText = mistakes;
        cpmTag.innerText = missed;
    } else {
        clearInterval(timer);
        inpField.value = "";
        typingText.querySelector('.active').classList.remove('active');
        $.post({
            url: "/save",
            data:{
                wpm: wpm,
                missed: missed,
                mistakes: mistakes,
            },
            success: function (data) {
                console.log(data);
                console.log('success post method');
            },
            error: function (data) {
                console.log(data['responseJSON']['error']);
            }
        });
        // console.log('ajax sent');
    }
}

function initTimer() {
    if (timeLeft > 0) {
        timeLeft--;
        timeTag.innerText = timeLeft;
        wpm = Math.round(((charIndex - mistakes) / 5) / (maxTime - timeLeft) * 60);
        wpmTag.innerText = wpm;
    } else {
        clearInterval(timer);
        console.log("init timer here")
        // send_ajax();
    }
}

function resetGame() {
    loadParagraph();
    clearInterval(timer);
    timeLeft = maxTime;
    charIndex = mistakes = isTyping = missed = 0;
    spaces = [];
    inpField.value = "";
    timeTag.innerText = timeLeft;
    wpmTag.innerText = 0;
    mistakeTag.innerText = 0;
    cpmTag.innerText = 0;
}

loadParagraph();
inpField.addEventListener("input", initTyping);
tryAgainBtn.addEventListener("click", resetGame);

document.addEventListener("keydown", (event) => { if (event.key === 'Escape') { resetGame(); } });


let marks = { '[': 'left_bracket', ']': 'right_bracket', ';': 'semicolon', "'": 'apostrophe', '.': 'dot', ',': 'comma', '/': 'slash', ' ': 'space' }

document.addEventListener('keydown', (event) => {
    let pressed_key;
    if (marks[event.key] !== undefined) {
        pressed_key = marks[event.key];
    } else {
        pressed_key = event.key;
    }
    let element = document.querySelector('.' + pressed_key + '');
    if (element) {
        element.classList.toggle('highlight');
    }
})

document.addEventListener('keyup', (event) => {
    let pressed_key;
    if (marks[event.key] !== undefined) {
        pressed_key = marks[event.key];
    } else {
        pressed_key = event.key;
    } let element = document.querySelector('.' + pressed_key + '');
    if (element) {
        element.classList.toggle('highlight');
    }
})


function kb_btn_handler() {
    let keymap_element = document.querySelector('.keymap');


    if (keymap_element.style.visibility !== 'hidden') {
        keymap_element.style.visibility = 'hidden';

    } else {
        keymap_element.style.visibility = '';
    }
}

document.querySelector('.kb_button').addEventListener('click', kb_btn_handler);

