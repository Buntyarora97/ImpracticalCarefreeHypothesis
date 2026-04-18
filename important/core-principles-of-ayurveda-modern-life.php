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
    <title>Core Principles of Wellness: Their Importance and Relevance in Today's Life</title>
    <meta name="description" content="Understand the core principles of Wellness and why they remain deeply relevant in today's fast-paced lifestyle for health, balance, and well-being.">
    <meta name="keywords" content="Core principles of Wellness, Importance of Wellness in modern life, Wellness lifestyle principles, Relevance of Wellness today, Wellness balance and wellness">
    
    <style>
        :root {
            --glimlach-deep-green: #556B2F;
            --glimlach-olive-green: #6B8E23;
            --glimlach-light-green: #9ACD32;
            --glimlach-gold: #FFD700;
            --glimlach-cream: #FDF6E3;
            --glimlach-text-dark: #2C3E50;
            --glimlach-shadow: 0 12px 45px rgba(85, 107, 47, 0.25);
            --glimlach-gold-glow: 0 10px 35px rgba(255, 215, 0, 0.35);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--glimlach-cream) 0%, #f1f7f2 100%);
            color: var(--glimlach-text-dark);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.8;
            overflow-x: hidden;
        }
        
        .glimlach-article-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 30px;
        }
        
        .glimlach-hero-section {
            background: linear-gradient(135deg, var(--glimlach-deep-green) 0%, var(--glimlach-olive-green) 50%, var(--glimlach-light-green) 100%);
            color: white;
            padding: 140px 80px;
            text-align: center;
            border-radius: 40px;
            margin: 40px 0 100px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--glimlach-shadow);
        }
        
        .glimlach-hero-section::before {
            content: '';
            position: absolute;
            top: -30%;
            left: -30%;
            width: 160%;
            height: 160%;
            background: radial-gradient(circle, rgba(255,215,0,0.25) 0%, transparent 70%);
            animation: glimlach-harmony 25s ease-in-out infinite;
        }
        
        @keyframes glimlach-harmony {
            0%, 100% { transform: rotate(0deg) scale(1); opacity: 0.7; }
            33% { transform: rotate(120deg) scale(1.1); opacity: 0.9; }
            66% { transform: rotate(240deg) scale(1.05); opacity: 0.8; }
        }
        
        .glimlach-hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 35px;
            position: relative;
            z-index: 2;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }
        
        .glimlach-hero-subtitle {
            font-size: 1.45rem;
            opacity: 0.95;
            max-width: 900px;
            margin: 0 auto 60px;
            position: relative;
            z-index: 2;
        }
        
        .glimlach-hero-image {
            width: 100%;
            max-width: 1200px;
            height: 550px;
            object-fit: cover;
            border-radius: 35px;
            margin: 0 auto;
            display: block;
            box-shadow: 0 35px 90px rgba(0,0,0,0.45);
            position: relative;
            z-index: 2;
        }
        
        .glimlach-section {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(30px);
            padding: 80px;
            margin-bottom: 70px;
            border-radius: 35px;
            box-shadow: var(--glimlach-shadow);
            border: 1px solid rgba(255, 255, 255, 0.35);
            position: relative;
            overflow: hidden;
        }
        
        .glimlach-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 10px;
            height: 100%;
            background: linear-gradient(180deg, var(--glimlach-gold), var(--glimlach-light-green));
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        }
        
        .glimlach-section-title {
            color: var(--glimlach-deep-green);
            font-size: 3rem;
            margin-bottom: 45px;
            font-weight: 700;
            position: relative;
            display: flex;
            align-items: center;
            gap: 25px;
        }
        
        .glimlach-section-title::after {
            content: '';
            position: absolute;
            bottom: -25px;
            left: 0;
            width: 120px;
            height: 8px;
            background: linear-gradient(90deg, var(--glimlach-gold), var(--glimlach-light-green));
            border-radius: 5px;
            box-shadow: 0 3px 15px rgba(255, 215, 0, 0.6);
        }
        
        .glimlach-principles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 50px;
            margin: 70px 0;
        }
        
        .glimlach-principle-card {
            background: linear-gradient(135deg, rgba(107,142,35,0.12), rgba(154,205,50,0.08));
            border: 4px solid rgba(107,142,35,0.3);
            border-radius: 30px;
            padding: 60px 50px;
            position: relative;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .glimlach-principle-card::before {
            content: '';
            position: absolute;
            top: 30px;
            right: 30px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, var(--glimlach-gold), transparent);
            border-radius: 50%;
            opacity: 0.2;
        }
        
        .glimlach-principle-card:hover {
            transform: translateY(-20px) scale(1.04);
            box-shadow: 0 40px 100px rgba(85,107,47,0.35);
            border-color: var(--glimlach-gold);
        }
        
        .glimlach-principle-number {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--glimlach-gold), #FFA500);
            color: var(--glimlach-deep-green);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 2rem;
            box-shadow: var(--glimlach-gold-glow);
            z-index: 2;
        }
        
        .glimlach-principle-icon {
            font-size: 4.5rem;
            margin-bottom: 30px;
            display: block;
            text-align: center;
        }
        
        .glimlach-principle-title {
            color: var(--glimlach-deep-green);
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .glimlach-modern-relevance {
            background: rgba(255,215,0,0.15);
            padding: 25px;
            border-radius: 20px;
            border-left: 6px solid var(--glimlach-gold);
            margin-top: 30px;
            font-weight: 600;
        }
        
        .glimlach-faq-item {
            margin-bottom: 40px;
        }
        
        .glimlach-faq-question {
            background: linear-gradient(135deg, var(--glimlach-deep-green), var(--glimlach-olive-green));
            color: white;
            padding: 35px 50px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1.25rem;
            cursor: pointer;
            margin-bottom: 25px;
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(85,107,47,0.4);
        }
        
        .glimlach-faq-question::after {
            content: '+';
            position: absolute;
            right: 35px;
            font-size: 2rem;
            font-weight: 300;
            transition: all 0.4s ease;
        }
        
        .glimlach-faq-question.active::after {
            content: '−';
            transform: rotate(180deg);
        }
        
        .glimlach-faq-answer {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(253,246,227,0.92));
            padding: 45px 50px;
            border-radius: 30px;
            border-left: 10px solid var(--glimlach-gold);
            display: none;
            animation: glimlach-slideDown 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(25px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        @keyframes glimlach-slideDown {
            from { opacity: 0; transform: translateY(-35px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .glimlach-cta-section {
            text-align: center;
            background: linear-gradient(135deg, var(--glimlach-gold) 0%, #FFB347 40%, #FF8C00 100%);
            color: var(--glimlach-deep-green);
            padding: 100px 80px;
            border-radius: 40px;
            margin: 100px 0 80px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--glimlach-gold-glow);
        }
        
        .glimlach-cta-buttons {
            display: flex;
            gap: 35px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 50px;
        }
        
        .glimlach-cta-button {
            background: linear-gradient(135deg, var(--glimlach-deep-green), var(--glimlach-olive-green));
            color: white;
            padding: 28px 60px;
            border-radius: 80px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.4rem;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 25px 60px rgba(85,107,47,0.45);
            position: relative;
            overflow: hidden;
        }
        
        .glimlach-cta-button:hover {
            transform: translateY(-12px);
            box-shadow: 0 35px 80px rgba(85,107,47,0.65);
        }
        
        @media (max-width: 768px) {
            .glimlach-article-container {
                padding: 0 20px;
            }
            .glimlach-hero-title {
                font-size: 2.6rem;
            }
            .glimlach-hero-section {
                padding: 100px 40px;
            }
            .glimlach-section {
                padding: 60px 35px;
            }
            .glimlach-principles-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .glimlach-hero-image {
                height: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="glimlach-article-container">
        <!-- Ultimate Hero Section -->
        <section class="glimlach-hero-section">
            <h1 class="glimlach-hero-title">🧠 Core Principles of Wellness</h1>
            <p class="glimlach-hero-subtitle">Their Importance and Relevance in Today's Life</p>
            <img src="assets/images/blogs/blog5.png" 
                 alt="Core principles of Wellness modern life" class="glimlach-hero-image">
        </section>

        <!-- Introduction -->
        <section class="glimlach-section">
            <p>In a world driven by speed, convenience, and constant stimulation, health problems have quietly become lifestyle problems. Stress, poor digestion, sleep disorders, and chronic fatigue are now common across all age groups.</p>
            <p style="margin-top: 40px; font-size: 1.2rem;">While modern medicine treats symptoms effectively, many people still search for balance, prevention, and long-term well-being. <strong>Wellness</strong> offers that missing foundation. Not as an outdated tradition, but as a practical life science built on principles that remain surprisingly relevant today.</p>
        </section>

        <!-- What Makes Wellness Different -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">🌱 What Makes Wellness Different?</h2>
            <p>Wellness does not define health as the absence of disease. It defines health as a state where the body, mind, digestion, sleep, and emotions function in harmony.</p>
            <p style="margin-top: 30px;">Its principles focus on:</p>
            <ul style="margin: 30px 0; padding-left: 35px; font-size: 1.15rem;">
                <li>✅ Understanding individuality</li>
                <li>✅ Maintaining balance</li>
                <li>✅ Preventing imbalance before disease begins</li>
                <li>✅ Aligning daily life with nature</li>
            </ul>
            <p style="margin-top: 30px; font-style: italic; font-size: 1.15rem; padding: 35px; background: rgba(154,205,50,0.15); border-radius: 25px; border-left: 8px solid var(--glimlach-gold);">
                These ideas feel even more necessary in today's lifestyle-driven health challenges.
            </p>
        </section>

        <!-- 7 Core Principles -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">⚖️ The Core Principles of Wellness Explained</h2>
            
            <div class="glimlach-principles-grid">
                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">1</div>
                    <div class="glimlach-principle-icon">⚖️</div>
                    <h3 class="glimlach-principle-title">Balance Is the Foundation of Health</h3>
                    <p>Wellness teaches that health exists when everything is in balance. This includes digestion, sleep, mental state, physical activity, and emotions.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Irregular routines, late nights, and processed foods disturb balance. Wellness thinking encourages restoring rhythm instead of relying only on medication.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">2</div>
                    <div class="glimlach-principle-icon">🔄</div>
                    <h3 class="glimlach-principle-title">The Tridosha Principle</h3>
                    <p>Every individual is governed by a unique combination of three energies: Vata (movement), Pitta (digestion), Kapha (structure).</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> This explains why the same diet or fitness plan doesn't work for everyone. Wellness promotes personalized health rather than one-size-fits-all solutions.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">3</div>
                    <div class="glimlach-principle-icon">🔥</div>
                    <h3 class="glimlach-principle-title">Agni: The Power of Digestion</h3>
                    <p>Agni represents digestive and metabolic strength. Strong digestion means better immunity, energy, and clarity.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Even healthy food can cause problems if digestion is weak. Wellness prioritizes gut health, which modern science now recognizes as central to wellness.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">4</div>
                    <div class="glimlach-principle-icon">🛡️</div>
                    <h3 class="glimlach-principle-title">Prevention Over Cure</h3>
                    <p>Wellness focuses on preventing disease through daily habits, diet, and seasonal adjustments.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Lifestyle disorders like diabetes, obesity, and stress-related illness can often be prevented with early corrections rather than late treatment.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">5</div>
                    <div class="glimlach-principle-icon">🕰️</div>
                    <h3 class="glimlach-principle-title">Living in Harmony with Nature</h3>
                    <p>Wellness emphasizes alignment with natural cycles such as day, night, and seasons.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Disrupted sleep, screen exposure, and indoor lifestyles disconnect us from natural rhythms. Wellness principles restore this lost alignment.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">6</div>
                    <div class="glimlach-principle-icon">🧠</div>
                    <h3 class="glimlach-principle-title">Mind and Body Are Interconnected</h3>
                    <p>Mental stress directly affects physical health. Wellness treats the mind and body as one system.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Anxiety, burnout, and emotional fatigue are now major health issues. Wellness integrates mental calmness into physical wellness.
                    </div>
                </div>

                <div class="glimlach-principle-card">
                    <div class="glimlach-principle-number">7</div>
                    <div class="glimlach-principle-icon">📅</div>
                    <h3 class="glimlach-principle-title">Daily Habits Shape Long-Term Health</h3>
                    <p>Wellness highlights the power of small, consistent daily actions.</p>
                    <div class="glimlach-modern-relevance">
                        <strong>Modern relevance:</strong> Irregular eating, skipped meals, and poor sleep accumulate into long-term health issues. Structured daily habits prevent this slow decline.
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Wellness Matters -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">🌍 Why Wellness Still Matters Today</h2>
            <p>Wellness remains relevant because it:</p>
            <ul style="margin: 40px 0; padding-left: 40px; font-size: 1.2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <li>✅ Supports preventive healthcare</li>
                <li>✅ Encourages self-awareness</li>
                <li>✅ Promotes sustainable habits</li>
                <li>✅ Reduces dependency on quick fixes</li>
                <li>✅ Aligns health with lifestyle</li>
            </ul>
            <p style="margin-top: 35px; font-weight: 600; color: var(--glimlach-deep-green); font-size: 1.15rem;">
                It does not reject modern medicine. It complements it by filling gaps that technology alone cannot address.
            </p>
        </section>
<!-- ADD THIS SECTION after "Why Wellness Still Matters Today" and before FAQs -->

<section class="glimlach-section">
    <h2 class="glimlach-section-title">⚖️ Wellness as a Lifestyle, Not a Treatment</h2>
    <p>Wellness works best when practiced as a way of life. It encourages:</p>
    
    <div class="glimlach-daily-habits" style="margin: 45px 0; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
        <div class="glimlach-habit-card">
            <strong>🍽️ Mindful eating</strong>
        </div>
        <div class="glimlach-habit-card">
            <strong>😴 Adequate rest</strong>
        </div>
        <div class="glimlach-habit-card">
            <strong>⚖️ Balanced work</strong>
        </div>
        <div class="glimlach-habit-card">
            <strong>🧠 Emotional regulation</strong>
        </div>
        <div class="glimlach-habit-card">
            <strong>🌿 Connection with nature</strong>
        </div>
    </div>
    
    <p style="margin-top: 40px; font-size: 1.2rem; font-weight: 700; padding: 40px; background: linear-gradient(135deg, rgba(154,205,50,0.2), rgba(255,215,0,0.15)); border-radius: 25px; border-left: 10px solid var(--glimlach-gold); text-align: center;">
        This approach makes health <strong>sustainable rather than reactive</strong>.
    </p>
</section>

        <!-- FAQs -->
        <section class="glimlach-section">
            <h2 class="glimlach-section-title">❓ Frequently Asked Questions (FAQs)</h2>
            
            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Are Wellness principles applicable in modern lifestyles?</div>
                <div class="glimlach-faq-answer">Yes. They can be adapted easily to busy schedules and modern routines.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Does Wellness conflict with modern medicine?</div>
                <div class="glimlach-faq-answer">No. Wellness complements modern healthcare by focusing on prevention and lifestyle balance.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Is Wellness only for people with health problems?</div>
                <div class="glimlach-faq-answer">No. Wellness is primarily preventive and beneficial for maintaining long-term wellness.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">How long does it take to see benefits?</div>
                <div class="glimlach-faq-answer">Improvements in digestion, energy, and mental clarity may appear within a few weeks of consistent practice.</div>
            </div>

            <div class="glimlach-faq-item">
                <div class="glimlach-faq-question">Can Wellness help manage stress?</div>
                <div class="glimlach-faq-answer">Yes. Wellness integrates mental balance as a core principle of health.</div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="glimlach-cta-section">
            <h2 style="font-size: 3.2rem; margin-bottom: 40px; font-weight: 800;">🌟 Ancient Principles for Modern Living</h2>
            <p style="font-size: 1.55rem; max-width: 850px; margin: 0 auto 60px; line-height: 1.8;">
                The core principles of Wellness are not outdated ideas. They are timeless guidelines for living well. 
                In a world of fast solutions and rising health concerns, Wellness offers something rare: balance, awareness, and sustainability.
            </p>
            <div class="glimlach-cta-buttons">
                <a href="https://glimlach.in/index.php" class="glimlach-cta-button" target="_blank">🌿 Visit GLIMLACH Home</a>
                <a href="https://glimlach.in/contact.php" class="glimlach-cta-button" target="_blank">📞 Contact GLIMLACH</a>
                <a href="/wellness-wellness-blog" class="glimlach-cta-button">← Wellness Wellness Blog</a>
            </div>
        </section>
    </div>

    <script>
        // Premium FAQ interactions
        document.querySelectorAll('.glimlach-faq-question').forEach((question, index) => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const isActive = answer.classList.contains('active');
                
                document.querySelectorAll('.glimlach-faq-answer').forEach(ans => ans.classList.remove('active'));
                document.querySelectorAll('.glimlach-faq-question').forEach(q => q.classList.remove('active'));
                
                if (!isActive) {
                    answer.classList.add('active');
                    question.classList.add('active');
                }
            });
        });

        // Staggered principle cards animation
        window.addEventListener('load', () => {
            document.querySelectorAll('.glimlach-principle-card').forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(60px) scale(0.95)';
                    card.style.transition = 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    
                    requestAnimationFrame(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0) scale(1)';
                    });
                }, index * 250);
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
