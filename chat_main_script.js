const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');

// Knowledge base for sign language

const signLanguageKnowledge = {
  'hello': 'To sign "hello", extend your fingers and thumb, then bring your hand toward your forehead.',
  'thank you': 'To sign "thank you", fingers of the open hand touch the chin and then the chest.',
  'yes': 'To sign "yes", make a fist with your dominant hand and move it up and down slightly.',
  'no': 'To sign "no", shake your head from side to side.',
  'help': 'To sign "help", hold your hands up with palms facing in and fingers together, then move your hands in a circle.',
  'sad': 'Expressing sadness: lower your eyebrows, downturn the corners of your mouth, and look downwards.',
  'family': 'To sign "family", bring both hands together in front of you, creating a circle with your fingers.',
  'love': 'To sign "love", cross your arms over your chest and give yourself a hug.',
  'happy': 'Expressing happiness: raise your eyebrows, smile widely, and clap your hands together.',
  'goodbye': 'To sign "goodbye", wave your open hand back and forth.',
  'sorry': 'To sign "sorry", make a fist and touch it to your chest, then move your hand in a small circle.',
  'please': 'To sign "please", rub your chest in a circular motion with the palm of your hand.',
  'name': 'To sign "name", point to your chest with your index finger.',
  'eat': 'To sign "eat", bring your fingers to your mouth as if picking up food and placing it into your mouth.',
  'drink': 'To sign "drink", bring your fingers to your mouth as if holding a cup and taking a sip.',
  'learn': 'To sign "learn", point to your temple with your index finger, indicating the process of acquiring knowledge.',
  'friend': 'To sign "friend", hook your index fingers together, symbolizing the connection between friends.',
  'happy birthday': 'To sign "happy birthday", clap your hands and then mime the motion of blowing out candles.',
  'excuse me': 'To sign "excuse me", raise your hand to get someones attention and then gesture an apology.',
  'time': 'To sign "time", point to your wrist as if indicating the position of a watch.',
  'weather': 'To sign "weather", gesture with your hands to represent the current weather conditions.',
  'color': 'To sign "color", show the sign for "C" by circling your fingers on the palm of your opposite hand.',
  'school': 'To sign "school", create an "S" shape with your dominant hand and tap it against your non-dominant hand.',
  'music': 'To sign "music", move your hands in a flowing motion, as if playing an invisible instrument.',
  'travel': 'To sign "travel", make a horizontal wave motion with your hand, indicating a journey.',
  'book': 'To sign "book", open your hands and bring them together, mimicking the motion of opening a book.',
  'computer': 'To sign "computer", tap your fingers on an imaginary keyboard in front of you.',
  'happy': 'Expressing intense happiness: raise your arms overhead and wiggle your fingers.',
  'sleep': 'To sign "sleep", rest your head on your hands and close your eyes.',
  'play': 'To sign "play", tap your fingertips together, mimicking the sound of tapping on a surface.',
  'dance': 'To sign "dance", move your hands and body in a rhythmic motion.',
  'nature': 'To sign "nature", mime the action of planting a seed and watching it grow.',
  'movie': 'To sign "movie", outline a rectangle shape in the air with your fingers.',
  'happy': 'Feeling contentment: gently pat your heart with your hands and smile.',
  'guitar': 'To sign "guitar", mimic playing a guitar with your hands.',
  'swim': 'To sign "swim", imitate swimming strokes with both hands.',
  'sun': 'To sign "sun", draw a circle in the air with your finger, representing the sun.',
  'bird': 'To sign "bird", bring your fingers together and flap your hands like wings.',
  'flower': 'To sign "flower", cup your hands together and mimic the opening of a flower.',
  'car': 'To sign "car", mimic holding a steering wheel and driving.',
  'mountain': 'To sign "mountain", create a triangle shape with your hands, representing a mountain peak.',
  'phone': 'To sign "phone", mime holding a phone to your ear.',
  'jump': 'To sign "jump", bend your knees and spring upwards with your hands in the air.',
  'rain': 'To sign "rain", simulate falling raindrops with your fingers.',
  'smile': 'To sign "smile", draw an upward curve with your fingers at the corners of your mouth.',
  'hat': 'To sign "hat", mime placing a hat on your head.',
  'beach': 'To sign "beach", draw a horizontal line in the air with your hands to represent the shoreline.',
  'tree': 'To sign "tree", raise your arms above your head and wiggle your fingers like branches.',
  'train': 'To sign "train", mime the motion of a train moving along a track with.',
  'camera': 'To sign "camera", create a rectangle shape with your hands and mimic taking a picture.',
  'run': 'To sign "run", move your arms in a running motion while staying in place.',
  'ice cream': 'To sign "ice cream", mimic holding an ice cream cone and licking it.',
  'key': 'To sign "key", make a twisting motion with your hand, as if turning a key in a lock.',
  'beauty': 'To sign "beauty", gesture towards your face and then spread your hands outward in a graceful motion.',
  'fire': 'To sign "fire", flick your fingers upward, representing flames.',
  'laugh': 'To sign "laugh", clap your hands together while smiling.',
  'sunglasses': 'To sign "sunglasses", mimic putting on sunglasses by tapping your fingers near your eyes.',
  'mountain': 'To sign "mountain", create a triangle shape with your hands, representing a mountain peak.',
  'camera': 'To sign "camera", create a rectangle shape with your hands and mimic taking a picture.',
  'bus': 'To sign "bus", make a horizontal motion with both hands, symbolizing a bus moving along a road.',
  'fruit': 'To sign "fruit", mime picking fruit from a tree and bringing it to your mouth.',
  'watch': 'To sign "watch", point to your wrist as if indicating the position of a watch.',
  'shoes': 'To sign "shoes", tap your fingers on the top of your foot, representing putting on shoes.',
  'rainbow': 'To sign "rainbow", draw an arch in the air with your fingers, symbolizing the colors of a rainbow.',
  'spoon': 'To sign "spoon", hold an imaginary spoon in one hand and bring it to your mouth.',
  'fork': 'To sign "fork", mimic holding a fork and bringing it towards your mouth.',
  'knife': 'To sign "knife", mimic holding a knife and cutting motion in the air.',
  'plate': 'To sign "plate", use both hands to mimic holding a plate in front of you.',
  'cup': 'To sign "cup", hold an imaginary cup with one hand and bring it to your mouth.',
  'napkin': 'To sign "napkin", mime using a napkin to wipe your mouth or hands.',
  'chocolate': 'To sign "chocolate", pretend to break a chocolate bar and bring it to your mouth.',
  'soup': 'To sign "soup", mime holding a bowl and bringing a spoon to your mouth.',
  'pizza': 'To sign "pizza", make a circular motion with both hands to mimic the shape of a pizza.',
  'hamburger': 'To sign "hamburger", mimic holding a burger with both hands and taking a bite.',
  'apple': 'To sign "apple", mime picking an apple from a tree and taking a bite.',
  'banana': 'To sign "banana", mimic peeling a banana and bringing it to your mouth.',
  'orange': 'To sign "orange", mime peeling an orange and bringing a slice to your mouth.',
  'grape': 'To sign "grape", use your fingers to pick grapes from an imaginary vine and eat them.',
  'sandwich': 'To sign "sandwich", stack your hands together to represent layers of a sandwich.',
  'cookie': 'To sign "cookie", mimic holding a cookie and taking a bite.',
  'spice': 'To sign "spice", use your fingers to sprinkle an imaginary spice into your food.',
};




  


  

  


// Rest of the code remains the same
// ...

// Initial welcome message with added information
addMessageToChat('Welcome! This is a sign language chatbot. Type a sign you want to learn about.', 'bot');

  
  

// Function to generate AI response
function generateResponse(message) {
  message = message.toLowerCase().trim();
  if (signLanguageKnowledge.hasOwnProperty(message)) {
    return signLanguageKnowledge[message];
  } else {
    return 'Sorry, I don\'t understand that sign. Can you please try again?';
  }
}

// Function to add message to chat box
function addMessageToChat(message, sender) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message', sender);
  messageElement.innerText = message;
  chatBox.appendChild(messageElement);
  chatBox.scrollTop = chatBox.scrollHeight;
}

// Function to handle user input
function sendMessage() {
  const message = userInput.value;
  if (message.trim() !== '') {
    addMessageToChat(message, 'user');
    const response = generateResponse(message);
    addMessageToChat(response, 'bot');
    userInput.value = '';
  }
}

// Initial welcome message
addMessageToChat('Welcome! Please type a sign you want to learn about.', 'bot');