<template>
    <div class="min-h-screen bg-purple-900 text-white flex flex-col lg:flex-row lg:items-center p-6 lg:p-10">
        <div class="w-full lg:w-1/2 flex justify-center lg:justify-end lg:pr-10 mb-10 lg:mb-0">
            <div>
                <img class="w-48 h-48 rounded-lg mb-6 lg:mb-0 lg:w-64 lg:h-64" :src="randomCoverArt()"
                     alt="Current song image" />
                <div v-if="isLoading" class="loader">Loading...</div>

                <div class="text-center lg:text-left">
                    <h3 class="text-xl font-semibold">{{ currentSong.title }}</h3>
                    <p class="text-sm text-purple-300">{{ currentSong.artist }}</p>
                </div>

            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <ul class="mb-10 lg:mb-6">
                <li
                    v-for="song in songs"
                    :key="song.id"
                    class="py-2 border-b border-purple-700 flex justify-between items-center cursor-pointer"
                    @click="selectSong(song)"
                >
                    <div class="flex items-center">
                        <div class="hidden lg:block mr-4 relative">
                            <i v-if="song.id === currentSong.id && isPlaying" class="fas fa-play w-6 h-6 text-white-500 rounded-full relative">
                                <span class="absolute -top-1 -left-2  w-full h-full rounded-full bg-white opacity-50"></span>
                            </i>
                            <i v-else-if="song.id === currentSong.id" class="fas fa-pause w-6 h-6 text-white-500 relative">
                                <span class="absolute -top-1 -left-2  w-full h-full rounded-full bg-white opacity-50"></span>
                            </i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold">{{ song.title }}</h3>
                            <p class="text-sm text-purple-300">{{ song.artist }}</p>
                        </div>
                    </div>
                    <div class="text-sm">{{ song.duration }}</div>
                </li>
            </ul>

            <div class="text-center">
                <div class="flex items-center justify-between text-sm mb-4">
                    <span>{{ formatTime(currentTimeInSeconds) }}</span>
                    <input type="range" class="w-full mx-2" min="0" :max="currentSong.durationInSeconds"
                           v-model="currentTimeInSeconds" @input="updateCurrentTime" />
                    <span>{{ formatTime(currentSong.durationInSeconds) }}</span>
                </div>

                <div class="flex justify-center">
                    <button @click="shuffle" class="mx-2">
                        <i class="fa-solid fa-shuffle w-8 h-8"></i>

                    </button>
                    <button @click="previousSong" class="mx-2">
                        <i class="fa-solid fa-backward-step w-8 h-8"></i>
                    </button>
                    <button @click="togglePlayPause" class="mx-2 rounded-full bg-white p-2 flex items-center justify-center shadow-md w-14 h-14">
                        <i v-if="!isPlaying" class="fas fa-play  text-black"></i>
                        <i v-else class="fas fa-pause  text-black"></i>
                    </button>



                    <button @click="nextSong" class="mx-2">
                        <i class="fa-solid fa-forward-step w-8 h-8"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import imgSRC from '../../../public/images/album-art/image1.png'
export default {

  data() {
    return {
      isLoading: false,

      songs: [
        {
          id: 1,
          title: 'Peaceful Piano Music',
          artist: 'Relaxing Piano Music',
          duration: '3:16',
          durationInSeconds: 196,
          image: imgSRC
        },
        {
          id: 2,
          title: 'Peaceful Guitar Music',
          artist: 'Relaxing Guitar Music',
          duration: '6:56',
          durationInSeconds: 416,
          image: 'https://picsum.photos/200/200'
        },
        {
          id: 3,
          title: 'Peaceful Trumpet Music',
          artist: 'Relaxing Trumpet Music',
          duration: '7:43',
          durationInSeconds: 463,
          image: 'https://picsum.photos/200/200'
        },
        {
          id: 4,
          title: 'Peaceful Drumbeat Music',
          artist: 'Relaxing Drumbeat Music',
          duration: '12:02',
          durationInSeconds: 722,
          image: 'https://picsum.photos/200/200'
        },
        {
          id: 5,
          title: 'Peaceful Violin Music',
          artist: 'Relaxing Violin Music',
          duration: '3:02',
          durationInSeconds: 182,
          image: 'https://picsum.photos/200/200'
        },
        {
          id: 6,
          title: 'Peaceful Tuba Music',
          artist: 'Relaxing Tuba Music',
          duration: '4:03',
          durationInSeconds: 243,
          image: 'https://picsum.photos/200/200'
        }
      ],
      currentSong: {
        id: 1,
        title: 'Peaceful Piano Music',
        artist: 'Relaxing Piano Music',
        duration: '3:16',
        durationInSeconds: 196,
        image: imgSRC
      },
      currentTime: '0:00',
      currentTimeInSeconds: 0,
      isPlaying: false
    }
  },
  methods: {
    randomCoverArt() {
      // Generate a random number to prevent caching
      const randomNum = Math.floor(Math.random() * 1000)
      return `https://picsum.photos/200/200?random=${randomNum}`
    },

    formatTime(seconds) {
      const minutes = Math.floor(seconds / 60)
      const remainingSeconds = seconds % 60
      return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`
    },
    updateCurrentTime() {
      // Update the current time based on slider value
      const minutes = Math.floor(this.currentTimeInSeconds / 60)
      const seconds = this.currentTimeInSeconds % 60
      this.currentTime = `${minutes}:${seconds.toString().padStart(2, '0')}`
    },
    togglePlayPause() {
      this.isPlaying = !this.isPlaying
    },
    nextSong() {
      const currentIndex = this.songs.findIndex(song => song.id === this.currentSong.id)
      const nextIndex = (currentIndex + 1) % this.songs.length
      this.currentSong = this.songs[nextIndex]
    },
    previousSong() {
      const currentIndex = this.songs.findIndex(song => song.id === this.currentSong.id)
      const previousIndex = (currentIndex - 1 + this.songs.length) % this.songs.length
      this.currentSong = this.songs[previousIndex]
    },
    shuffle() {
      const randomIndex = Math.floor(Math.random() * this.songs.length)
      this.currentSong = this.songs[randomIndex]
    },
    selectSong(song) {
      this.currentSong = song
    },
    imageLoaded() {
      this.isLoading = false // Set loading state to false when image is loaded
    }

  }
}
</script>

<style scoped>
input[type="range"] {
    -webkit-appearance: none;
    width: 100%;
    background: transparent;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: white;
    cursor: pointer;
    margin-top: -5px; /* Aligns the thumb to the center of the track */
}

input[type="range"]::-webkit-slider-runnable-track {
    width: 100%;
    height: 3px;
    background: white;
    border-radius: 1.5px;
}
</style>
