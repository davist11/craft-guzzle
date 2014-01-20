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

```
{% for item in craft.guzzle.get({ url: 'https://api.github.com/users/davist11/repos', limit: 10, offset: 5 }) %}
	<li>{{ item.name }}</li>
{% endfor %}
```

## Future Plans

* Additional request types
* Authentication
* Other fun stuff you can do with Guzzle!