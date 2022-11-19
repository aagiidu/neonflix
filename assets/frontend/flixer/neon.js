const q = [1080, 720, 640];
let dp, episode, c, m, episodes, type, poster;
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
c += '            <img src="/assets/global/controls/play.svg" />';
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
m += '            <img src="/assets/global/controls/play.svg" />';
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

function setMovie(url, poster){
   
    let quality = [];
    for (let i = 0; i < q.length; i++) {
        quality.push({
            name: q[i] + 'p',
            url: `https://stream.neontoon.mn/video/movie/${url}/${q[i]}`,
            type: 'auto',
        });
    }
    dp = new DPlayer({
        container: document.getElementById('dplayer'),
        autoplay: false,
        theme: '#FADFA3',
        loop: false,
        lang: 'MN-mn',
        //screenshot: true,
        hotkey: true,
        preload: 'auto',
        logo: '/assets/global/logo_h50.png',
        danmaku: false,
        volume: 0.7,
        mutex: true,
        contextmenu: [],
        video: {
            quality,
            defaultQuality: 1,
            pic: poster,
            // thumbnails: 'thumbnails.jpg',
        },
    });

    $('.dplayer-icons-left').after(m)
    $('.dplayer-icons-left button.dplayer-play-icon').hide()

    $('.playbtn').on('click', function(){
        dp.toggle();
    })

    dp.on('play', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/pause.svg');
    })

    dp.on('pause', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/play.svg');
    })	
}

function setMedia(episode){
    if(dp) {
        dp.destroy();
    }
    $(`#episodes li`).removeClass('selected');
    $(`#episodes .${episode.episode_id}`).addClass('selected');
    //$('#movieTitle').text(episode.title)
    
    $('.chosen').text(q[0] + 'p');
    let quality = [];
    for (let i = 0; i < q.length; i++) {
        quality.push({
            name: q[i] + 'p',
            url: `https://stream.neontoon.mn/video/${type}/${episode.url}/${q[i]}`,
            type: 'auto',
        });
    }
    dp = new DPlayer({
        container: document.getElementById('dplayer'),
        autoplay: false,
        theme: '#FADFA3',
        loop: false,
        lang: 'MN-mn',
        //screenshot: true,
        hotkey: true,
        preload: 'auto',
        logo: '/assets/global/logo_h50.png',
        danmaku: false,
        volume: 0.7,
        mutex: true,
        contextmenu: [],
        video: {
            quality,
            defaultQuality: 1,
            pic: poster,
            // thumbnails: 'thumbnails.jpg',
        },
    });

    $('.dplayer-icons-left').after(c)
    $('.dplayer-icons-left button.dplayer-play-icon').hide()

    $('.playbtn').on('click', function(){
        dp.toggle();
    })

    dp.on('play', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/pause.svg');
    })

    dp.on('pause', function(){
        $('.playbtn').find('img').attr('src', '/assets/global/controls/play.svg');
    })	
}

function nback(){
    console.log('backbtn')
    let current = dp.video.currentTime
    dp.seek(current >= 10 ? current - 10 : 0);
}

function nskip(){
    console.log('skipbtn')
    let current = dp.video.currentTime
    dp.seek(current + 10);
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