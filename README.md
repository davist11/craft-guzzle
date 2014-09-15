# Guzzle Plugin for Craft

Simple plugin to perform an HTTP GET request using [Guzzle](http://docs.guzzlephp.org/en/latest/index.html)

## Usage

```
{% for item in craft.guzzle.get({ url: 'https://api.github.com/users/davist11/repos' }) %}
	<li>{{ item.name }}</li>
{% endfor %}
```

## Parameters

* URL (**required**)
* Limit
* Offset
* Expire (The number of seconds in which the cached value will expire. 0 means never expire.)

```
{% for item in craft.guzzle.get({ url: 'https://api.github.com/users/davist11/repos', limit: 10, offset: 5, expire: 43200 }) %}
	<li>{{ item.name }}</li>
{% endfor %}
```

## Future Plans

* Additional request types
* Authentication
* Other fun stuff you can do with Guzzle!