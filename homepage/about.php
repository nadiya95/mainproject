<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Vows and Values</title>
    <link rel="stylesheet" href="about.css">
    <style>
        /* Dark Mode Styles */
        body {
            background-color: #1e1e1e; /* Dark background */
            color: #eaeaea; /* Light text for contrast */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1, h2, h3, h4 {
            color: #c06169; /* Accent color from your scheme */
            margin: 15px 0;
        }

        /* Button Style */
        .btn {
            background-color: #c06169;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #d77480;
        }

        /* About Us Content */
        .about-us {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .about-banner {
            background-color: #444;
            padding: 30px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .about-banner .banner-content h2 {
            margin-bottom: 10px;
        }

        /* List Styles */
        .about-us ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }

        .about-us ul li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .about-us ul li span.emoji {
            font-size: 1.5em;
            margin-right: 10px;
        }

        .closing, .signature {
            margin-top: 20px;
            font-style: italic;
        }

        .signature {
            font-weight: bold;
            color: #c06169;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1>Vows and Values</h1>
        <h2>Connecting Hearts with Meaning</h2>

        <section class="about-us">
            <h3>About Us</h3>
            <p>Welcome to <strong>Vows and Values</strong>: Connecting Hearts with Meaning!</p>
            <p>At <strong>Vows and Values</strong>, we believe that marriage is more than just a union—it's a connection of two souls, two families, and two worlds. Our mission? To make that connection as meaningful and joyful as possible!</p>

            <section class="about-banner">
                <div class="banner-content">
                    <h2>Real Stories, Real Connections</h2>
                    <p>Discover how Vows and Values has helped countless individuals find their perfect match.</p>
                    <a href="success-stories.php" class="btn">Read Their Stories</a>
                </div>
            </section>

            <h4>Why Choose Us?</h4>
            <ul>
                <li><span class="emoji">🌟</span> <strong>Meaningful Matches</strong>: We go beyond the superficial. Using our unique compatibility algorithms and personality quizzes, we ensure that every match is not just a connection but a meaningful one.</li>
                <li><span class="emoji">💬</span> <strong>Stories with a Smile</strong>: We’ve had the joy of witnessing countless love stories unfold. Each success story is a testament to the power of a well-matched union.</li>
                <li><span class="emoji">🎥</span> <strong>See the Real You</strong>: Upload a video, share your story, and let your personality shine! We know that the right person will love you just the way you are.</li>
                <li><span class="emoji">🎯</span> <strong>Custom Hashtags</strong>: Add hashtags to your profile and find those who share your interests. Because love should be as unique as you are!</li>
                <li><span class="emoji">🤝</span> <strong>Supportive Community</strong>: Our platform is more than just a meeting place; it’s a community. We’re here to support you every step of the way.</li>
            </ul>
            <p>At <strong>Vows and Values</strong>, we promise to provide a safe, respectful, and joyful environment where you can find your perfect match. True love isn’t just about finding someone to marry; it’s about finding someone who makes your life complete.</p>
            <p class="closing">Join us, and let’s connect hearts with meaning. Your love story starts here!</p>
            <p class="signature">💖 <strong>Vows and Values - Where every match is a promise.</strong></p>
        </section>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
