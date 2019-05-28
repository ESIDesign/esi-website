import $ from 'jquery';

// let words = document.getElementsByClassName('word');
let $words = $('[data-js-word]');
let wordArray = [];
let currentWord = 0;
let animationCount = 0;
let animationInterval = 1000;

$words.eq(0).css('opacity', 1.0);
$words.each(function() {
  let $this = $(this);
  splitLetters($this);
});

function changeWord() {
  let cw = wordArray[currentWord];
  let nw = currentWord == $words.length-1 ? wordArray[0] : wordArray[currentWord+1];

  $words.eq(currentWord + 1).css('opacity', 1.0);

  for (let i = 0; i < cw.length; i++) {
    animateLetterOut(cw, i);
  }

  for (let i = 0; i < nw.length; i++) {
    nw[i].className = 'letter behind';
    animateLetterIn(nw, i);
  }

  currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
}

function animateLetterOut(cw, i) {
  setTimeout(function() {
    cw[i].className = 'letter out';
  }, i*80);
}

function animateLetterIn(nw, i) {
  setTimeout(function() {
    nw[i].className = 'letter in';
  }, 340+(i*80));
}

function splitLetters($word) {
  let content = $word.find('span:not(".letter")').html();
  $word.find('span').html('');
  let letters = [];
  if (content) {
    for (let i = 0; i < content.length; i++) {
      let letter = document.createElement('span');
      letter.className = 'letter';
      letter.innerHTML = content.charAt(i);
      $word.find('span:not(".letter")').append(letter);
      letters.push(letter);
    }
  }
  wordArray.push(letters);
}

let intervalFunction = () => {
  changeWord();
  animationCount++;
  if (animationCount >= 2) {
    animationInterval = 3000;
  }
  setTimeout(intervalFunction, animationInterval);
};

export default {
  start() {
    changeWord();
    setTimeout(intervalFunction, animationInterval);
  },
};
