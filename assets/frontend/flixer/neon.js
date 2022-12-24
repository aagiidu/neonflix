// const q = [1080, 720, 640];
let dp, episode, c, m, episodes, type, poster, timer;
let currentEpisodeIndex = 0;

c = '<div id="centerctrl" class="dplayer-icons max-player-icons-center" >';
c += '    <button class="dplayer-icon dplayer-backward-icon" onclick="nback()">';
c += '        <span class="dplayer-icon-content">';
c += '            <img src="/assets/global/controls/back.svg" />';
c += '        </span>';
c += '    </button>';
c += '    <button class="dplayer-icon dplayer-prev-icon" onclick="nprev()">';
c += '        <span class="dplayer-icon-content">';
c += '            <img src="/assets/global/controls/prev.svg" />';
c += '        </span>';
c += '    </button>';
c += '    <button class="dplayer-icon dplayer-play-icon playbtn">';
c += '        <span class="dplayer-icon-content">';
c += '            <img src="/assets/global/controls/play.svg" id="playbtn" />';
c += '        </span>';
c += '    </button>';
c += '    <button class="dplayer-icon dplayer-next-icon" onclick="nnext()">';
c += '        <span class="dplayer-icon-content">';
c += '            <img src="/assets/global/controls/next.svg" />';
c += '        </span>';
c += '    </button>';
c += '    <button class="dplayer-icon dplayer-forward-icon" onclick="nskip()">';
c += '        <span class="dplayer-icon-content">';
c += '            <img src="/assets/global/controls/skip.svg" />';
c += '        </span>';
c += '    </button>';
c += '</div>';

m = '<div id="centerctrl" class="dplayer-icons max-player-icons-center" >';
m += '    <button class="dplayer-icon dplayer-backward-icon" onclick="nback()">';
m += '        <span class="dplayer-icon-content">';
m += '            <img src="/assets/global/controls/back.svg" />';
m += '        </span>';
m += '    </button>';
m += '    <button class="dplayer-icon dplayer-play-icon playbtn">';
m += '        <span class="dplayer-icon-content">';
m += '            <img src="/assets/global/controls/play.svg" id="playbtn" />';
m += '        </span>';
m += '    </button>';
m += '    <button class="dplayer-icon dplayer-forward-icon" onclick="nskip()">';
m += '        <span class="dplayer-icon-content">';
m += '            <img src="/assets/global/controls/skip.svg" />';
m += '        </span>';
m += '    </button>';
m += '</div>';

function initNeonPlayer(data, t, p){
    type = t;
    episodes = data;
    episode = episodes[0];
    poster = p;
    //c = $('#centerctrl').detach();
    setMedia(episode);
}

function playEpisode(episodeId){
    episode = episodes.find((e, i) => {
        currentEpisodeIndex = i;
        return e.episode_id === episodeId.toString()
    });
    console.log('episode chosen', episode)
    setMedia(episode);
}

function setMovie(url, poster, q){
   
    let quality = [];
    for (let i = 0; i < q.length; i++) {
        quality.push({
            name: q[i] + 'p',
            url: window.location.href.includes('localhost') ? `http://localhost:8000/video/movie/${url}/${q[i]}` : `https://stream.neontoon.mn/video/movie/${url}/${q[i]}`,
            type: 'auto',
        });
    }
    dp = new DPlayer({
        container: document.getElementById('dplayer'),
        autoplay: false,
        theme: '#FADFA3',
        loop: false,
        lang: 'MN-mn',
        // screenshot: true,
        hotkey: true,
        preload: 'auto',
        // logo: '/assets/global/logo_h50.png',
        danmaku: false,
        volume: 0.7,
        mutex: true,
        contextmenu: [],
        video: {
            quality,
            defaultQuality: 0,
            pic: poster,
            // thumbnails: 'thumbnails.jpg',
        },
    });
    $('.dplayer-video-wrap video').after(m)
    // $('.dplayer-icons-left').after(m)
    $('.dplayer-icons-left button.dplayer-play-icon').hide()

    /* $(document).on('.playbtn img', 'click', function(){
        console.log('toggling')
        dp.toggle();
    }) */

    /* document.getElementById('playbtn').addEventListener(`click`, () => {
        console.log('toggling')
        dp.toggle();
    }); */

    dp.on('play', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/pause.svg');
        setTimeout(() => {
            console.log('hiding')
            $('#dplayer').addClass('dplayer-hide-controller')
        }, 3000)
    })

    dp.on('pause', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/play.svg');
    })	
}

$(document).on('click', 'video.dplayer-video', function(){
    console.log('video.dplayer-video')
    if($('#dplayer').hasClass('dplayer-hide-controller')){
        console.log('removing')
        $('#dplayer').removeClass('dplayer-hide-controller')
    }else{
        $('#dplayer').addClass('dplayer-hide-controller')
    }
    /* setTimeout(() => {
        if($('#dplayer').hasClass('dplayer-hide-controller')){
            console.log('removing')
            $('#dplayer').removeClass('dplayer-hide-controller')
        }
    }, 200) */
})

/* document.onclick = function(e) {
    
      var el = e.target.getAttribute('id');
      if(el == 'playbtn'){
        console.log('toggling')
        dp.toggle();
      }
      console.log(el);
    
} */

function setMedia(episode){

    if(dp) {
        dp.destroy();
    }
    let q = episode.qlt || ['720'];
    $(`#episodes li`).removeClass('selected');
    $(`#episodes .${episode.episode_id}`).addClass('selected');
    //$('#movieTitle').text(episode.title)
    
    $('.chosen').text(q[0] + 'p');
    let quality = [];
    for (let i = 0; i < q.length; i++) {
        console.log(`https://stream.neontoon.mn/video/${type}/${episode.url}/${q[i]}`)
        quality.push({
            name: q[i] + 'p',
            url: `https://stream.neontoon.mn/video/${type}/${episode.url}/${q[i]}`,
            type: 'auto',
        });
    }
    console.log('quality', quality)
    dp = new DPlayer({
        container: document.getElementById('dplayer'),
        autoplay: false,
        theme: '#FADFA3',
        loop: false,
        airplay: true,
        lang: 'MN-mn',
        // screenshot: true,
        hotkey: true,
        preload: 'auto',
        // logo: '/assets/global/logo_h50.png',
        danmaku: false,
        volume: 0.7,
        mutex: true,
        contextmenu: [],
        video: {
            quality,
            defaultQuality: 0,
            pic: poster,
            // thumbnails: 'thumbnails.jpg',
        },
    });

    $('.dplayer-video-wrap video').after(c)
    //$('.dplayer-icons-left').after(c)
    $('.dplayer-icons-left button.dplayer-play-icon').hide()

    $('.playbtn').on('click', function(){
        dp.toggle();
    })

    dp.on('play', function(){
        console.log('onPlayEvent')
        $('.playbtn').find('img').attr('src', '/assets/global/controls/pause.svg');
        setTimeout(() => {
            console.log('hiding')
            $('#dplayer').addClass('dplayer-hide-controller')
        }, 3000)
    })

    dp.on('pause', function(){
        console.log('onPauseEvent')
        $('.playbtn').find('img').attr('src', '/assets/global/controls/play.svg');
    })	
}

function nback(){
    console.log('backbtn')
    let current = dp.video.currentTime
    dp.seek(current >= 10 ? current - 10 : 0);
    console.log('ismobile', window.mobileAndTabletCheck())
    //if(window.mobileAndTabletCheck() == false){
        //dp.toggle()
    //}
}

function nskip(){
    console.log('skipbtn')
    let current = dp.video.currentTime
    dp.seek(current + 10)
    console.log('ismobile', window.mobileAndTabletCheck())
    //if(window.mobileAndTabletCheck() == false){
        //dp.toggle()
    //}
}

function nprev(){
    console.log('prevbtn')
    currentEpisodeIndex = currentEpisodeIndex > 0 ? currentEpisodeIndex - 1 : currentEpisodeIndex
    episode = episodes[currentEpisodeIndex];
    setMedia(episode);
}

function nnext(){
    console.log('nextbtn')
    currentEpisodeIndex = currentEpisodeIndex < episodes.length - 1 ? currentEpisodeIndex + 1 : currentEpisodeIndex
    episode = episodes[currentEpisodeIndex];
    setMedia(episode);
}

document.getElementById('dplayer').addEventListener(`mousemove`, () => {
    console.log('mousemove', $(window).width())
    //if($(window).width() > 768) {
        if($('#dplayer').hasClass('dplayer-hide-controller')){
            $('#dplayer').removeClass('dplayer-hide-controller')
        }
        clearTimeout(timer)
        timer = setTimeout(onMouseStopped, 4000)
    //}
})

function onMouseStopped(){
    console.log('Mouse Stopped');
    $('#dplayer').addClass('dplayer-hide-controller');
}

window.mobileAndTabletCheck = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};