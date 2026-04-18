<?php  
$header_path = __DIR__ . '/includes/header.php';  
if (file_exists($header_path)) {  
    include $header_path;  
} else {  
    include 'header.php';  
}  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Immunity Boost: The Role of Wellness Herbs in Modern Wellness</title>
    <meta name="description" content="Discover how Wellness herbs support daily immunity and overall wellness. Learn how ancient remedies fit seamlessly into modern healthy living.">
    <meta name="keywords" content="Daily immunity boost, Wellness herbs for immunity, Natural immunity boosters, Wellness immunity supplements, Herbal immunity support">
    <style>
        :root {
            --glimlach-deep-green: #556B2F;
            --glimlach-olive-green: #6B8E23;
            --glimlach-light-green: #9ACD32;
            --glimlach-gold: #FFD700;
            --glimlach-cream: #FDF6E3;
            --glimlach-text-dark: #2C3E50;
            --glimlach-shadow: 0 8px 32px rgba(85, 107, 47, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--glimlach-cream);
            color: var(--glimlach-text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            overflow-x: hidden;
        }
        
        .glimlach-article-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .glimlach-hero-section {
            background: linear-gradient(135deg, var(--glimlach-deep-green), var(--glimlach-olive-green));
            color: white;
            padding: 100px 40px;
            text-align: center;
            border-radius: 25px;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--glimlach-shadow);
        }
        
        .glimlach-hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
            animation: glimlach-float 20s ease-in-out infinite;
        }
        
        @keyframes glimlach-float {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }
        
        .glimlach-hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }
        
        .glimlach-hero-image {
            width: 100%;
            max-width: 800px;
            /* height: 400px; */
            object-fit: cover;
            border-radius: 20px;
            margin: 40px auto;
            display: block;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .glimlach-section {
            background: white;
            padding: 50px;
            margin-bottom: 40px;
            border-radius: 20px;
            box-shadow: var(--glimlach-shadow);
            border-left: 6px solid var(--glimlach-gold);
        }
        
        .glimlach-section-title {
            color: var(--glimlach-deep-green);
            font-size: 2.2rem;
            margin-bottom: 30px;
            font-weight: 700;
            position: relative;
        }
        
        .glimlach-section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--glimlach-gold);
            border-radius: 2px;
        }
        
        .glimlach-herb-card {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 30px;
            align-items: center;
            padding: 30px;
            background: linear-gradient(135deg, #f8fff5, #e8f5e8);
            border-radius: 15px;
            margin-bottom: 25px;
            border: 2px solid var(--glimlach-light-green);
            transition: all 0.3s ease;
        }
        
        .glimlach-herb-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(107, 142, 35, 0.2);
        }
        
        .glimlach-herb-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--glimlach-olive-green), var(--glimlach-light-green));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 10px 30px rgba(107, 142, 35, 0.3);
        }
        
        .glimlach-herb-info h4 {
            color: var(--glimlach-deep-green);
            font-size: 1.4rem;
            margin-bottom: 10px;
        }
        
        .glimlach-best-for {
            background: var(--glimlach-gold);
            color: var(--glimlach-deep-green);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }
        
        .glimlach-routine-list {
            list-style: none;
            padding-left: 0;
        }
        
        .glimlach-routine-list li {
            background: rgba(107, 142, 35, 0.1);
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--glimlach-olive-green);
            transition: all 0.3s ease;
        }
        
        .glimlach-routine-list li:hover {
            background: rgba(107, 142, 35, 0.2);
            transform: translateX(10px);
        }
        
        .glimlach-faq-item {
            margin-bottom: 25px;
        }
        
        .glimlach-faq-question {
            background: linear-gradient(135deg, var(--glimlach-deep-green), var(--glimlach-olive-green));
            color: white;
            padding: 20px 30px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        
        .glimlach-faq-answer {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            border-left: 5px solid var(--glimlach-gold);
            display: none;
            animation: glimlach-slideDown 0.4s ease;
        }
        
        .glimlach-faq-answer.active {
            display: block;
        }
        
        @keyframes glimlach-slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .glimlach-cta-section {
            text-align: center;
            background: linear-gradient(135deg, var(--glimlach-gold), #FFA500);
            color: var(--glimlach-deep-green);
            padding: 60px 40px;
            border-radius: 25px;
            margin-top: 60px;
        }
        
        .glimlach-cta-button {
            background: var(--glimlach-deep-green);
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(85, 107, 47, 0.4);
        }
        
        .glimlach-cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(85, 107, 47, 0.6);
        }
        
        @media (max-width: 768px) {
            .glimlach-hero-title {
                font-size: 2rem;
            }
            .glimlach-hero-section {
                padding: 60px 20px;
            }
            .glimlach-section {
                padding: 30px 20px;
            }
            .glimlach-herb-card {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="glimlach-article-container">
        <!-- Hero Section -->
        <section class="glimlach-hero-section">
            <h1 class="glimlach-hero-title">Daily Immunity Boost: The Role of Wellness Herbs in Modern Wellness</h1>
            <img src="assets/images/blogs/blog1.png" alt="Wellness herbs for daily immunity boost" class="glimlach-hero-image">
        </section>

        <!-- Introduction -->
        <section class="glimlach-section">
            <p>In today's fast-paced world, immunity is no longer a seasonal concern. It is a daily priority. Long work hours, irregular meals, environmental stress, and digital fatigue quietly weaken the body's natural defense system.</p>
            <p style="margin-top: 25px;">This is where Wellness steps in, not as a trend, but as a time-tested science of balance. Wellness does not promise instant fixes. Instead, it focuses on <strong>daily immunity building</strong>, strengthening the body gradually through natural herbs, lifestyle alignment, and internal harmony.</p>
            <p style="margin-top: 25px;">When ancient wisdom meets modern wellness, the result is sustainable health that fits seamlessly into contemporary life.</p>
        </section>

        <!-- Understanding Immunity -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">🧠 Understanding Immunity Through Wellness</h2>
            <p>In Wellness, immunity is referred to as <strong>Ojas</strong>. Ojas represents vitality, resilience, and the body's ability to protect and repair itself. Strong Ojas means better resistance to illness, faster recovery, and stable energy levels.</p>
            <p style="margin-top: 20px;">Unlike modern medicine, which often reacts after illness occurs, Wellness emphasizes <strong>preventive immunity care</strong>. The goal is to nourish the body every day so it becomes less vulnerable to stress, infections, and fatigue.</p>
        </section>

        <!-- Top 5 Herbs -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">🌿 Top 5 Wellness Herbs for Daily Immunity Boost</h2>
            
            <div class="glimlach-herb-card">
                <div class="glimlach-herb-icon">🌿</div>
                <div class="glimlach-herb-info">
                    <h4>1. Ashwagandha – The Stress Shield</h4>
                    <p>Ashwagandha is an adaptogenic herb known for helping the body manage physical and mental stress. Chronic stress is one of the biggest immunity suppressors. By balancing cortisol levels, Ashwagandha indirectly strengthens immune response while improving sleep and energy.</p>
                    <div class="glimlach-best-for">Stress-related fatigue • Low energy • Modern lifestyle burnout</div>
                </div>
            </div>

            <div class="glimlach-herb-card">
                <div class="glimlach-herb-icon">🍀</div>
                <div class="glimlach-herb-info">
                    <h4>2. Giloy – The Immunity Climber</h4>
                    <p>Often called Amrita in Wellness, Giloy is known for its immune-modulating properties. It supports the body's natural defense mechanism and helps maintain internal balance, especially during seasonal changes.</p>
                    <div class="glimlach-best-for">Recurrent infections • Seasonal immunity dips • Overall immune resilience</div>
                </div>
            </div>

            <div class="glimlach-herb-card">
                <div class="glimlach-herb-icon">🌱</div>
                <div class="glimlach-herb-info">
                    <h4>3. Tulsi – The Everyday Protector</h4>
                    <p>Tulsi, or Holy Basil, has antimicrobial and antioxidant properties. It supports respiratory health and helps the body adapt to environmental stressors like pollution and allergens.</p>
                    <div class="glimlach-best-for">Respiratory wellness • Daily immunity maintenance • Urban living environments</div>
                </div>
            </div>

            <div class="glimlach-herb-card">
                <div class="glimlach-herb-icon">🍈</div>
                <div class="glimlach-herb-info">
                    <h4>4. Amla – The Vitamin C Powerhouse</h4>
                    <p>Amla is one of the richest natural sources of Vitamin C. Unlike synthetic supplements, Amla supports immunity without overheating the body, making it suitable for long-term daily use.</p>
                    <div class="glimlach-best-for">Antioxidant protection • Skin and gut health • Long-term immune support</div>
                </div>
            </div>

            <div class="glimlach-herb-card">
                <div class="glimlach-herb-icon">🫚</div>
                <div class="glimlach-herb-info">
                    <h4>5. Turmeric – The Inflammation Balancer</h4>
                    <p>Turmeric contains curcumin, which helps manage inflammation and oxidative stress. Healthy immunity depends on balanced inflammation, not complete suppression.</p>
                    <div class="glimlach-best-for">Joint health • Inflammation control • Metabolic wellness</div>
                </div>
            </div>
        </section>

        <!-- Daily Routine -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">🕰️ How to Build a Daily Immunity Routine with Wellness</h2>
            <p>A strong immune system is built through small daily habits:</p>
            <ul class="glimlach-routine-list">
                <li>✅ Start the day with warm water or herbal infusions</li>
                <li>✅ Include immunity-supporting herbs consistently</li>
                <li>✅ Maintain regular sleep cycles</li>
                <li>✅ Eat seasonal, whole foods</li>
                <li>✅ Manage stress through movement or mindfulness</li>
            </ul>
            <p style="margin-top: 25px;"><strong>Consistency matters more than quantity.</strong> Wellness works best when followed gently but regularly.</p>
        </section>

        <!-- FAQs -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">❓ Frequently Asked Questions (FAQs)</h2>
            
            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Q1. Can Wellness herbs be taken daily for immunity?</div>
                <div class="glimlach-faq-answer active">Yes. Many Wellness herbs are designed for long-term daily use when taken in appropriate doses and formats.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Q2. Are Wellness immunity boosters safe with modern supplements?</div>
                <div class="glimlach-faq-answer">In most cases, yes. However, it is best to consult a healthcare professional to avoid interactions.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Q3. How long does it take to see results?</div>
                <div class="glimlach-faq-answer">Wellness focuses on gradual improvement. Benefits such as better energy, digestion, and resilience may be noticed within a few weeks of consistent use.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Q4. Can Wellness help with stress-related immunity issues?</div>
                <div class="glimlach-faq-answer">Absolutely. Herbs like Ashwagandha and Tulsi directly support stress management, which plays a major role in immune health.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Q5. Is Wellness suitable for all age groups?</div>
                <div class="glimlach-faq-answer">Yes, but formulations and dosages may vary depending on age, health condition, and lifestyle.</div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="glimlach-cta-section">
            <h2 style="font-size: 2.5rem; margin-bottom: 20px; font-weight: 700;">🌟 Build Immunity the Natural Way</h2>
            <p style="font-size: 1.3rem; margin-bottom: 30px;">Daily immunity is cultivated through mindful choices, consistent habits, and respect for the body's natural rhythm.</p>
            <a href="/wellness-wellness-blog" class="glimlach-cta-button">Explore More Wellness Articles</a>
        </section>
    </div>

    <script>
        // Simple FAQ toggle functionality
        document.querySelectorAll('.glimlach-faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.classList.toggle('active');
            });
        });
    </script>

<?php  
$footer_path = __DIR__ . '/includes/footer.php';  
if (file_exists($footer_path)) {  
    include $footer_path;  
} else {  
    include 'footer.php';  
}  
?>  
</body>
</html>
