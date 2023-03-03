
function convertToEnglish(banglaValue) {
  var englishValue = "";
  var numerals = {
    "০": "0",
    "১": "1",
    "২": "2",
    "৩": "3",
    "৪": "4",
    "৫": "5",
    "৬": "6",
    "৭": "7",
    "৮": "8",
    "৯": "9",
    "0": "0",
    "1": "1",
    "2": "2",
    "3": "3",
    "4": "4",
    "5": "5",
    "6": "6",
    "7": "7",
    "8": "8",
    "9": "9",
  };

  for (var i = 0; i < banglaValue.length; i++) {
    englishValue += numerals[banglaValue[i]];
  }

  return parseFloat(englishValue);
}





function convertToBangla(englishValue) {
  var banglaValue = "";
  var numerals = {
    "0": "০",
    "1": "১",
    "2": "২",
    "3": "৩",
    "4": "৪",
    "5": "৫",
    "6": "৬",
    "7": "৭",
    "8": "৮",
    "9": "৯",
  };

  if (isNaN(englishValue) && typeof englishValue !== "string") {
    return "Invalid input";
  }

  var englishString = englishValue.toString();
  for (var i = 0; i < englishString.length; i++) {
    banglaValue += numerals[englishString[i]];
  }

  return banglaValue;
}

