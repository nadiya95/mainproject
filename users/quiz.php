<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality quiz</title>
    <link rel="stylesheet" href="../css/quiz.css">
</head>
<body>
      <h2>Personality Quiz</h2>
                    <form id="mbtiQuizForm" method="POST" action="../handlers/quiz_handler.php">
                        <!-- Extraversion vs. Introversion -->
                        <fieldset>
                            <legend>Extraversion vs. Introversion</legend>
                            <div class="question">
                                <p>1. Do you enjoy being the center of attention at social events?</p>
                                <label><input type="radio" name="extraversionIntroversion1" value="E"> Yes</label><br>
                                <label><input type="radio" name="extraversionIntroversion1" value="I"> No</label>
                            </div>
                            <div class="question">
                                <p>2. Do you prefer to work in a team rather than independently?</p>
                                <label><input type="radio" name="extraversionIntroversion2" value="E"> Yes</label><br>
                                <label><input type="radio" name="extraversionIntroversion2" value="I"> No</label>
                            </div>
                            <div class="question">
                                <p>3. Do you feel drained after spending time in large groups?</p>
                                <label><input type="radio" name="extraversionIntroversion3" value="E"> Yes</label><br>
                                <label><input type="radio" name="extraversionIntroversion3" value="I"> No</label>
                            </div>
                        </fieldset>
            
                        <!-- Sensing vs. Intuition -->
                        <fieldset>
                            <legend>Sensing vs. Intuition</legend>
                            <div class="question">
                                <p>1. Do you focus more on the details rather than the overall concept?</p>
                                <label><input type="radio" name="sensingIntuition1" value="S"> Yes</label><br>
                                <label><input type="radio" name="sensingIntuition1" value="N"> No</label>
                            </div>
                            <div class="question">
                                <p>2. Are you more interested in how things work rather than why they work?</p>
                                <label><input type="radio" name="sensingIntuition2" value="S"> Yes</label><br>
                                <label><input type="radio" name="sensingIntuition2" value="N"> No</label>
                            </div>
                            <div class="question">
                                <p>3. Do you prefer practical applications over theoretical ideas?</p>
                                <label><input type="radio" name="sensingIntuition3" value="S"> Yes</label><br>
                                <label><input type="radio" name="sensingIntuition3" value="N"> No</label>
                            </div>
                        </fieldset>
            
                        <!-- Thinking vs. Feeling -->
                        <fieldset>
                            <legend>Thinking vs. Feeling</legend>
                            <div class="question">
                                <p>1. Do you make decisions based more on logic than on personal values?</p>
                                <label><input type="radio" name="thinkingFeeling1" value="T"> Yes</label><br>
                                <label><input type="radio" name="thinkingFeeling1" value="F"> No</label>
                            </div>
                            <div class="question">
                                <p>2. Is it important for you to maintain harmony and avoid conflicts in relationships?</p>
                                <label><input type="radio" name="thinkingFeeling2" value="T"> Yes</label><br>
                                <label><input type="radio" name="thinkingFeeling2" value="F"> No</label>
                            </div>
                            <div class="question">
                                <p>3. Do you value fairness and objectivity over empathy in decision-making?</p>
                                <label><input type="radio" name="thinkingFeeling3" value="T"> Yes</label><br>
                                <label><input type="radio" name="thinkingFeeling3" value="F"> No</label>
                            </div>
                        </fieldset>
            
                        <!-- Judging vs. Perceiving -->
                        <fieldset>
                            <legend>Judging vs. Perceiving</legend>
                            <div class="question">
                                <p>1. Do you prefer having a set plan and sticking to it rather than improvising?</p>
                                <label><input type="radio" name="judgingPerceiving1" value="J"> Yes</label><br>
                                <label><input type="radio" name="judgingPerceiving1" value="P"> No</label>
                            </div>
                            <div class="question">
                                <p>2. Are you more comfortable when tasks are completed before a deadline?</p>
                                <label><input type="radio" name="judgingPerceiving2" value="J"> Yes</label><br>
                                <label><input type="radio" name="judgingPerceiving2" value="P"> No</label>
                            </div>
                            <div class="question">
                                <p>3. Do you like to keep your options open and adapt to new information?</p>
                                <label><input type="radio" name="judgingPerceiving3" value="J"> Yes</label><br>
                                <label><input type="radio" name="judgingPerceiving3" value="P"> No</label>
                            </div>
                        </fieldset>
                        <div class="button-container">
                        <button type="submit" name="previous">Previous</button>  
                        <button type="submit" name="register">Register </button>   
                        </div> 
                    </form>
    <script>
    // Descriptions for MBTI types and their compatible types
    const descriptions = {
        ESTJ: {
            description: 'ESTJ: The Executive. Practical, realistic, and decisive. They value order and structure, and they thrive on organizing and leading others.',
            compatible: ['ISFP', 'INFP', 'ENTP']
        },
        ISFP: {
            description: 'ISFP: The Adventurer. Quiet, friendly, sensitive, and kind. They enjoy living in the moment and are deeply attuned to their surroundings.',
            compatible: ['ESTJ', 'ENFJ', 'INTP']
        },
        INFP: {
            description: 'INFP: The Mediator. Idealistic, loyal to their values, and deeply caring. They are driven by a strong sense of personal values and purpose.',
            compatible: ['ESTJ', 'ENTP', 'ISFJ']
        },
        ENTP: {
            description: 'ENTP: The Debater. Innovative, clever, and curious. They love exploring new ideas and engaging in debates to stimulate their intellect.',
            compatible: ['ESTJ', 'INFP', 'ISFJ']
        },
        ISTJ: {
            description: 'ISTJ: The Logistician. Responsible, organized, and practical. They are detail-oriented and highly dependable, thriving in structured environments.',
            compatible: ['ESFP', 'ESTP', 'ISFJ']
        },
        ESFP: {
            description: 'ESFP: The Performer. Outgoing, friendly, and spontaneous. They love to entertain and enjoy life to the fullest, often bringing energy and fun to those around them.',
            compatible: ['ISTJ', 'ISFJ', 'ESTJ']
        },
        ISFJ: {
            description: 'ISFJ: The Defender. Nurturing, reliable, and devoted. They are compassionate and dedicated to helping others, often placing their needs above their own.',
            compatible: ['ESFP', 'ISTJ', 'ESTP']
        },
        ESTP: {
            description: 'ESTP: The Entrepreneur. Energetic, perceptive, and action-oriented. They love taking risks and are always on the lookout for new opportunities and challenges.',
            compatible: ['ISFJ', 'ISTJ', 'ESFJ']
        },
        INFJ: {
            description: 'INFJ: The Advocate. Insightful, reserved, and highly principled. They are driven by a strong sense of purpose and are often dedicated to helping others.',
            compatible: ['ENFP', 'ENTP', 'INFP']
        },
        ENFP: {
            description: 'ENFP: The Campaigner. Enthusiastic, creative, and sociable. They thrive on new experiences and are highly empathetic, often inspiring others with their passion.',
            compatible: ['INFJ', 'INTJ', 'ENTJ']
        },
        INTJ: {
            description: 'INTJ: The Architect. Strategic, analytical, and determined. They are highly independent thinkers, always planning for the future and seeking to achieve their goals.',
            compatible: ['ENFP', 'ENTP', 'INFJ']
        },
        ENTJ: {
            description: 'ENTJ: The Commander. Bold, confident, and strong-willed. They are natural leaders, always looking for ways to improve efficiency and achieve success.',
            compatible: ['INTP', 'INTJ', 'ENFP']
        },
        INTP: {
            description: 'INTP: The Logician. Innovative, curious, and analytical. They love exploring complex ideas and are driven by a desire to understand the world around them.',
            compatible: ['ENTJ', 'ENTP', 'INFJ']
        },
        ESFJ: {
            description: 'ESFJ: The Consul. Caring, sociable, and highly attuned to others\' needs. They are dedicated to creating harmony and making sure everyone feels included.',
            compatible: ['ISFP', 'ISTP', 'ESTP']
        },
        ISTP: {
            description: 'ISTP: The Virtuoso. Practical, resourceful, and independent. They are skilled problem-solvers who enjoy working with their hands and mastering new tools.',
            compatible: ['ESFJ', 'ESTJ', 'ISFP']
        },
        ENFJ: {
            description: 'ENFJ: The Protagonist. Charismatic, empathetic, and inspiring. They are natural leaders, often helping others to realize their potential and achieve their goals.',
            compatible: ['INFP', 'ISFP', 'INTP']
        }
    };

    // Function to get a description for a type
    function getDescription(type) {
        return descriptions[type] ? descriptions[type].description : 'No description available.';
    }

    // Function to get compatible types' descriptions
    function getCompatibleDescriptions(type) {
        if (descriptions[type]) {
            return descriptions[type].compatible.map(t => `${t}: ${getDescription(t)}`).join('\n');
        }
        return 'No compatible types found.';
    }

    document.addEventListener('DOMContentLoaded', function() {
        var formElement = document.querySelector('#mbtiQuizForm');
        if (formElement) {
            formElement.addEventListener('submit', function(event) {
                if (event.submitter && event.submitter.name === 'register') {
                    event.preventDefault(); // Prevent default form submission

                    // Collecting responses
                    const responses = {
                        E: 0,
                        I: 0,
                        S: 0,
                        N: 0,
                        T: 0,
                        F: 0,
                        J: 0,
                        P: 0
                    };

                    document.querySelectorAll('input[type="radio"]:checked').forEach((radio) => {
                        responses[radio.value]++;
                    });

                    const personalityType = [
                        responses.E > responses.I ? 'E' : 'I',
                        responses.S > responses.N ? 'S' : 'N',
                        responses.T > responses.F ? 'T' : 'F',
                        responses.J > responses.P ? 'J' : 'P'
                    ].join('');

                    const personalityDescription = getDescription(personalityType);
                    const compatibleDescriptions = getCompatibleDescriptions(personalityType);
                      // Display results 
                      alert(`Your MBTI personality type is ${personalityType}\n\n${personalityDescription}`);
                      alert(`Compatible types:\n\n${compatibleDescriptions}`);

                    // Create hidden fields with name attributes
                    const hiddenPersonalityType = document.createElement('input');
                    hiddenPersonalityType.type = 'hidden';
                    hiddenPersonalityType.name = 'personalityType';
                    hiddenPersonalityType.value = personalityType;

                    const hiddenPersonalityDesc = document.createElement('input');
                    hiddenPersonalityDesc.type = 'hidden';
                    hiddenPersonalityDesc.name = 'personalityDescription';
                    hiddenPersonalityDesc.value = personalityDescription;

                    const hiddenCompatibleDesc = document.createElement('input');
                    hiddenCompatibleDesc.type = 'hidden';
                    hiddenCompatibleDesc.name = 'compatibleDescriptions';
                    hiddenCompatibleDesc.value = compatibleDescriptions;

                    // Create hidden input to mimic register button
                    const hiddenRegister = document.createElement('input');
                    hiddenRegister.type = 'hidden';
                    hiddenRegister.name = 'register';  // Same as button's name attribute
                    hiddenRegister.value = 'register';  // Value to check in PHP

                    // Append hidden fields to the form
                    formElement.appendChild(hiddenPersonalityType);
                    formElement.appendChild(hiddenPersonalityDesc);
                    formElement.appendChild(hiddenCompatibleDesc);
                    formElement.appendChild(hiddenRegister);  // Append hidden register input

                    // Submit the form
                    formElement.submit();
                }
            });
        } else {
            console.error('Form element with id "mbtiQuizForm" not found.');
        }
    });

</script>
</body>
</html>            
            
            
            
    
    