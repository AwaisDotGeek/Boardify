<template>
    <!-- Nav here -->
    <header>
        <nav>

            <div class="logo-container">
                <div class="logo-img-container">
                    <img src="./assets/logo.png" alt="logo" class="logo-img">
                </div>
                <h2 class="logo-text">Boardify</h2>
            </div>

            <div class="nav-links-container">
                <ul class="nav-links">
                    <li class="nav-link-item"><RouterLink to="" class="link">Home</RouterLink></li>
                    <span class="nav-link-separater">|</span>
                    <li class="nav-link-item"><RouterLink to="" class="link">Products</RouterLink></li>
                    <span class="nav-link-separater">|</span>
                    <li class="nav-link-item"><RouterLink to="" class="link">About</RouterLink></li>
                    <span class="nav-link-separater">|</span>
                    <li class="nav-link-item"><RouterLink to="" class="link">Contact</RouterLink></li>
                </ul>
            </div>
        
        </nav>
    </header>

    <GameCard id="chess" gameName="Chess" gameHeadText="Unleash Your Strategic Brilliance!" imgSrc="./assets/chess-medium.jpg">
        <template v-slot:gameText>
            Greetings, noble players! I am Chess, the timeless 
            battleground where minds clash in a symphony of strategy 
            and tactics. Engage in a dance of cunning moves, daring 
            sacrifices, and triumphant checkmates. Whether you're a 
            grandmaster or a novice, I offer an exhilarating journey 
            through centuries of rich tradition and intellectual 
            prowess. Unveil your inner tactician, predict your opponent's 
            every step, and emerge victorious in this regal duel of wits. 
            Join me, and let's embark on an epic quest to conquer the checkered 
            realm with your strategic might! 🏰♟️👑
        </template>
    </GameCard>

    <GameCard id="ludo" gameName="Ludo" gameHeadText="Roll the Dice, Create Memories, and Seize Victory!" imgSrc="./assets/chess-medium.jpg">
        <template v-slot:gameText>
            Greetings, adventurers of all ages! I am Ludo, 
            the timeless classic that brings joy, camaraderie, 
            and a dash of luck to your gaming gatherings. 
            Embark on a colorful journey as you navigate your 
            tokens across the board, evading pitfalls and 
            forging alliances. With every roll of the dice, 
            friendships are strengthened, laughter echoes 
            through the air, and thrilling comebacks await. 
            Whether you're strategizing for supremacy or 
            savoring the thrill of chance, Ludo promises a 
            rollercoaster of emotions and unforgettable moments. 
            Join me, and let's embark on an exhilarating ride of fun, 
            competition, and cherished memories that last a lifetime! 🎲🌈🏆
        </template>
    </GameCard>

    <MyFooter></MyFooter>
    
</template>

<script>
    import MyFooter from "./components/MyFooter.vue";
    import GameCard from "./components/GameCard.vue";
    export default {
        components: {
            MyFooter,
            GameCard,    
        }    
    }
</script>

<style scoped>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }   

    /* Navbar */
    nav {
        width: 100%;
        background: #212b2a;
        padding: 10px 8%;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo */
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .logo-img-container {
        width: 50px;
        height: 50px;
    }

    .logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .logo-text {
        color: #eee;
        letter-spacing: 1px;
    }

    /* Nav-links */
    .nav-links {
        display: flex;
        gap: 15px;
    }

    .nav-link-item {
        list-style-type: none; 
    }

    .nav-link-separater {
        color: #ccc;
    }
    

   @media (max-width: 767px) {
        nav {
            padding: 10px 3%;
        }
   }

</style>