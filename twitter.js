new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 6,
  interval: 6000,
  width: 280,
  height: 400,
  theme: {
    shell: {
      background: '#280e1f',
      color: '#e2b400'
    },
    tweets: {
      background: '#ffffff',
      color: '#525252',
      links: '#fdb813'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('kineret').start();
