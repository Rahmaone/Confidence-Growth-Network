const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById("progressText");
const scoreText = document.getElementById("score");
const progressBarFull = document.getElementById("progressBarFull");
const loader = document.getElementById('loader');
const kuiz = document.getElementById('kuiz');
let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];
let timerElement = document.getElementById("timer");
let timeRemaining = 30; // Waktu dalam detik untuk setiap pertanyaan
let timerInterval;

let questions = [
];

fetch(
    'https://opentdb.com/api.php?amount=10&category=17&difficulty=easy&type=multiple'
)
    .then((res) => {
        return res.json();
    })
    .then((loadedQuestions) => {
        questions = loadedQuestions.results.map((loadedQuestion) => {
            const formattedQuestion = {
                question: loadedQuestion.question,
            };

            const answerChoices = [...loadedQuestion.incorrect_answers];
            formattedQuestion.answer = Math.floor(Math.random() * 4) + 1;
            answerChoices.splice(
                formattedQuestion.answer - 1,
                0,
                loadedQuestion.correct_answer
            );

            answerChoices.forEach((choice, index) => {
                formattedQuestion['choice' + (index + 1)] = choice;
            });

            return formattedQuestion;
        });
        startkuiz();
    })
    .catch((err) => {
        console.error(err);
    });

//CONSTANTS
const CORRECT_BONUS = 10;
const MAX_QUESTIONS = 10;

startkuiz = () => {
    questionCounter = 0;
    score = 0;
    availableQuesions = [...questions];
    loader.classList.remove('hidden');  // Tampilkan loader
    kuiz.classList.add('hidden');
    setTimeout(() => {
      getNewQuestion();
      loader.classList.add('hidden');  // Hapus loader setelah 3 detik
      kuiz.classList.remove('hidden');
    }, 1000); // Tunggu selama 3 detik
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
      window.location.assign(`hasilkuiz?score=${score}`);
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
      } else {
        // Tampilkan jawaban yang benar
        const correctChoice = choices.find(
          choice => choice.dataset["number"] == currentQuestion.answer
        );
        correctChoice.parentElement.classList.add("correct");
      }
  
      selectedChoice.parentElement.classList.add(classToApply);
  
      setTimeout(() => {
        selectedChoice.parentElement.classList.remove(classToApply);
        const correctChoice = choices.find(
          choice => choice.dataset["number"] == currentQuestion.answer
        );
        correctChoice.parentElement.classList.remove("correct");
        getNewQuestion();
      }, 1500); // Tambahkan jeda untuk menunjukkan jawaban yang benar
    });
  });
  
  incrementScore = num => {
    score += num;
    scoreText.innerText = score;
  };
