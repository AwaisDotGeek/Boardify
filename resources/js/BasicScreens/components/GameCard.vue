<template>
    <section :id="id" class="game-section">
        <div class="game-img-container">
            <img :src="getImgSrc" alt="" class="game-img">
        </div>
        <div class="game-details-container">
            <div class="game-text-container">
                <h3 class="game-details-heading "><span style="font-size: x-large; color: #fff;">{{gameName}}:</span> {{gameHeadText}}</h3>
                <p class="game-text">
                    <slot name="gameText"></slot>
                </p>
            </div>
            <div class="game-btns-container">
                <button class="game-btn learn-btn">Let's Learn</button>
                <button class="game-btn play-btn">Let's Play</button>
            </div>
        </div>
    </section>
</template>

<script>
    import chessImage from '../assets/chess.jpg';
    import ludoImage from '../assets/ludo.jpg';
    import rangImage from '../assets/rang.jpg';
    import snackers from '../assets/snackers.jpg';
    export default {
        props: ['id', 'gameName', 'gameHeadText'],
        computed: {
            getImgSrc() {
                switch (this.gameName) {
                    case 'Chess':
                        return chessImage;
                    case 'Ludo':
                        return ludoImage;
                    case 'Rang':
                        return rangImage;
                    case 'Snakes and Ladders':
                        return snackers;
                }
                return ludoImage;
            }    
        }
    }
</script>

<style scoped>
    .game-section {
        margin: 45px 8%;
        box-shadow: 0 0 5px 0 #fff;
        padding: 15px;
        border-radius: 10px;
        min-height: 250px;
        position: relative;

        display: flex;
        gap: 10px;
    }
    .game-section:hover
    {
        box-shadow: 0 0 10px 0 #fff;
    }

    .game-details-container {
        padding-right: 10px;
        width: 50%;
        
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 50px;
    }

    .game-details-heading {
        color: #eee;
        margin-bottom: 5px;
    }
    .game-text {
        text-align: left;
        color: #fff;
        font-size: 16.5px;
        letter-spacing: 0.3px;
        margin-top: 15px;
        line-height: 1.3;
    }

    .game-img-container {
        max-width: 50%;
        border-radius: 10px 0 0 10px;
        overflow: hidden;
    }

    .game-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px 0 0 10px;
        filter: brightness(0.7); /* Adjust the brightness of the image */
        transition: transform 0.3s, filter 0.3s;
    }

    .game-img:hover {
        transform: scale(1.05); /* Add a slight scale effect on hover */
        filter: brightness(1);
    }

    .game-btns-container {
        align-self: flex-end;

        display: flex;
        gap: 5px;
    }

    .game-btn {
        padding: 10px 25px;
        border-radius: 10px;
        border: none;
        font-weight: bold;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .play-btn {
        background: #030f11;
        color: #fff;
    }

    .play-btn:hover {
        box-shadow: 0 0 3px 0 #fff;
        transform: translateY(-2px);
    }

    .learn-btn:hover {
        background: #212b2a;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 0 3px 0 #fff;
    }

    @media (max-width: 767px) {
        .game-section {
            margin: 20px 3%;
        }

        .game-img {
            min-height: 100%;
        }

        .game-text {
            font-size: 14.5px;
        }
   }
</style>