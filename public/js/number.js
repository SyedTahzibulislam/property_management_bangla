
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
