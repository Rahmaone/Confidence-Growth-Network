const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById("progressText");
const scoreText = document.getElementById("score");
const progressBarFull = document.getElementById("progressBarFull");
let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];
let timerElement = document.getElementById("timer");
let timeRemaining = 30; // Waktu dalam detik untuk setiap pertanyaan
let timerInterval;

let questions = [
  {
    question: "Makanan apa yang paling enak di Indonesia?",
    choice1: "Nasi Uduk",
    choice2: "Ayam Sabana",
    choice3: "Bakwan Jagung",
    choice4: "Indomie Goreng",
    answer: 4
  },
  {
    question:
      "What is the correct syntax for referring to an external script called 'xxx.js'?",
    choice1: "<script href='xxx.js'>",
    choice2: "<script name='xxx.js'>",
    choice3: "<script src='xxx.js'>",
    choice4: "<script file='xxx.js'>",
    answer: 3
  },
  {
    question: " How do you write 'Hello World' in an alert box?",
    choice1: "msgBox('Hello World');",
    choice2: "alertBox('Hello World');",
    choice3: "msg('Hello World');",
    choice4: "alert('Hello World');",
    answer: 4
  }
];

//CONSTANTS
const CORRECT_BONUS = 10;
const MAX_QUESTIONS = 3;

startGame = () => {
    questionCounter = 0;
    score = 0;
    availableQuesions = [...questions];
    getNewQuestion();
  };
  
  startTimer = () => {
    timeRemaining = 30; // Reset waktu untuk setiap pertanyaan
    timerElement.innerText = timeRemaining;
  
    timerInterval = setInterval(() => {
      timeRemaining--;
      timerElement.innerText = timeRemaining;
  
      if (timeRemaining <= 0) {
        clearInterval(timerInterval);
        getNewQuestion(); // Lewati ke pertanyaan berikutnya jika waktu habis
      }
    }, 1000);
  };

  getNewQuestion = () => {
    if (availableQuesions.length === 0 || questionCounter >= MAX_QUESTIONS) {
      clearInterval(timerInterval);
      localStorage.setItem("mostRecentScore", score);
      return window.location.assign(`/service5?score=${score}`);
    }
  
    questionCounter++;
    progressText.innerText = `Question ${questionCounter}/${MAX_QUESTIONS}`;
    progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;
  
    const questionIndex = Math.floor(Math.random() * availableQuesions.length);
    currentQuestion = availableQuesions[questionIndex];
    question.innerText = currentQuestion.question;
  
    choices.forEach(choice => {
      const number = choice.dataset["number"];
      choice.innerText = currentQuestion["choice" + number];
    });
  
    availableQuesions.splice(questionIndex, 1);
    acceptingAnswers = true;
    startTimer(); // Mulai timer untuk pertanyaan baru
  };
  
  choices.forEach(choice => {
    choice.addEventListener("click", e => {
      if (!acceptingAnswers) return;
  
      acceptingAnswers = false;
      clearInterval(timerInterval); // Hentikan timer ketika pengguna memilih jawaban
  
      const selectedChoice = e.target;
      const selectedAnswer = selectedChoice.dataset["number"];
  
      const classToApply =
        selectedAnswer == currentQuestion.answer ? "correct" : "incorrect";
  
      if (classToApply === "correct") {
        incrementScore(CORRECT_BONUS);
      }
  
      selectedChoice.parentElement.classList.add(classToApply);
  
      setTimeout(() => {
        selectedChoice.parentElement.classList.remove(classToApply);
        getNewQuestion();
      }, 1000);
    });
  });
  
  incrementScore = num => {
    score += num;
    scoreText.innerText = score;
  };
  
  startGame();
