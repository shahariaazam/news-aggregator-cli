## News Aggregator CLI

Get news headlines from command line OR you can get news from Docker container.

```bash
docker run -it --rm shaharia/news-aggregator:latest php ./bin/news news:headlines --list bbc-home
```

### Available News Provider Slugs
- Prothom Alo North America Category `prothomalo-nortamerica-category`
- BBC Homepage `bbc-home`