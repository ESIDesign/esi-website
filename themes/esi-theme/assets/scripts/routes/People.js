import * as d3 from 'd3';
import Grid from 'd3-v4-grid';
// import { forceCluster } from 'd3-force-cluster';

export default {

  init() {

    let isOrganized = true;
    let $layoutButton = $('[data-js-layout-switch]');
    let $overlayControls = $('[data-js-overlay-control]');
    let isIE11 = !!(navigator.userAgent.match(/Trident/) && navigator.userAgent.match(/rv[ :]11/));

    $overlayControls.on('click', function(e) {
      e.preventDefault();
      let instance = $.fancybox.getInstance();
      let $this = $(this);

      if ($this.hasClass('prev-button')) {
        instance.previous(0);
      } else {
        instance.next(0);
      }
      
      window.location.hash = $("h3", instance.current.$content[0]).html().replace(/ /g, "-").replace(/'/g, '').toLowerCase();
    });

    let data = window.peopleData || [];
    let factoids = window.factoids || [];
    let dataDictionary = {};

    factoids.sort(() => {
      return 0.5 - Math.random();
    });

    factoids = factoids.slice(0, 4);

    data.forEach((item) => {
      if (item.type === 'person') {
        dataDictionary[item.id] = item;
      }
    });

    let leaders = data.filter((item) => {
      return item.isLeader;
    });

    let nonLeaders = data.filter((item) => {
      return !item.isLeader;
    });

    let nonLeadersAndFactoids = [];

    if (isIE11) {
      nonLeadersAndFactoids = nonLeaders;
    } else {
      nonLeadersAndFactoids = [...nonLeaders, ...factoids];
    }

    nonLeadersAndFactoids.sort(() => {
      return 0.5 - Math.random();
    });

    let finalData = [...leaders, ...nonLeadersAndFactoids];

    let dataHeightIndex;
    let height;
    let $window = $(window);
    let wWidth = $window.outerWidth(true);
    let containerLeftOffset;
    let numColumns = 4;
    let useGrid = true;
    let translateOffset = 0;

    if (wWidth <= 1024 && wWidth > 768) {
      numColumns = 3;
      dataHeightIndex = Math.ceil(finalData.length / numColumns);
      height = 275 * dataHeightIndex;
      translateOffset = 100;

    } else if (wWidth <= 768 && wWidth > 670) {
      numColumns = 2;
      dataHeightIndex = Math.ceil(finalData.length / numColumns);
      height = 285 * dataHeightIndex;
      translateOffset = 210;

    } else if (wWidth <= 670) {
      dataHeightIndex = Math.ceil(finalData.length);
      height = 275 * dataHeightIndex;
      numColumns = 1;
      useGrid = false;

    } else {
      dataHeightIndex = Math.ceil(finalData.length / numColumns);
      height = 260 * dataHeightIndex;
    }

    let $map = $('[data-js-map]');
    let $masterContainer = $('[data-js-master-container]');
    let width = $map.width();
    let radius = 80;
    containerLeftOffset = $map.offset().left;

    let svg = d3.select('[data-js-map]')
      .append('svg')
      .classed('people-holder', true)
      .classed('center', true)
      .classed('mv5', true)
      .classed('pb5', true)
      .attr('width', width)
      .attr('height', height);

    let defs = svg.append('defs').attr('id', 'imgdefs');

    let patterns = {};

    data.forEach((item) => {
      if (item.type === 'person') {
        patterns[`${item.id}`] = defs.append('pattern')
                                  .attr("id", `pattern-${item.id}`)
                                  .attr("height", 1)
                                  .attr("width", 1)
                                  .attr("x", "0")
                                  .attr("y", "0");
      }
    });

    Object.keys(patterns).forEach((key) => {
      patterns[key].append('image')
        .attr("x", 0)
         .attr("y", 0)
         .attr("height", 160)
         .attr("width", 160)
         .attr("xlink:href", dataDictionary[key].image);
    });

    let processedNodes;

    if (useGrid) {
      const grid = Grid() // create new grid layout
        .bands([true])
        .padding([0, 20])
        .nodeSize([275, 260])
        // .size([width, height])
        .cols([numColumns])
        .data(finalData);

      grid.layout();

      processedNodes = grid.nodes().map((node) => {
        node['ox'] = node.x + translateOffset;
        node['oy'] = node.y;
        return node;
      });

    } else {
      processedNodes = finalData.map((node, index) => {
        node.x = (width / 2);
        node.y = index * 275
        node['ox'] = node.x;
        node['oy'] = node.y;
        return node;
      });
    }

    $layoutButton.on('click', (e) => {
      e.preventDefault();

      if (isOrganized) {
        $map.addClass('is-disorganized');
        $masterContainer.addClass('is-disorganized');
        force.alphaTarget(0.5).restart();
        isOrganized = false;
        $layoutButton.find('.button-label').html('Line Up');

      } else {
        $map.removeClass('is-disorganized');
        $masterContainer.removeClass('is-disorganized');
        force.stop();
        isOrganized = true;
        $layoutButton.find('.button-label').html('Disorganize');
      }
    });

    let $peopleGroup = $('[data-js-people-overlay]');

    function openPersonOverlay(d) {
      if (d.name && d.hasBio) {
        let galleryTarget = d.name.replace(/ /g, '-').replace(/'/g, '').toLowerCase();
        let galleryIndex = $(`#${galleryTarget}`).data('index');
        if (galleryTarget !== 'you?' && galleryIndex !== false) {
          window.location.hash = galleryTarget;
          $.fancybox.open($peopleGroup, {
            loop: true,
            arrows: false,
            baseClass : '',
            smallBtn:false,
            margin: [0, 0],
            hash: '',
            buttons: [],
            clickContent: false,
            clickSlide: false,
            clickOutside: false,
            dblclickContent: false,
            dblclickSlide: false,
            dblclickOutside: false,
          }, galleryIndex);
        }
      } else if (d.name === 'you?') {
        window.location.href = '/jobs';
      }
    }

    let circle = svg.selectAll('circle')
      .data(processedNodes)
      .enter()
      .append('g')
      .attr('transform', function(d) { return `translate(${d.ox}, ${d.oy})`; })
      .classed('node', true)
      .classed('is-you', function(d) {
        return d.name === 'you?';
      })
      .on('click', function(d) {
        if (d3.event.defaultPrevented) return;
        openPersonOverlay(d);
      })
      .call(d3.drag()
        .on('start', dragstarted)
        .on('drag', dragged)
        .on('end', dragended))

    circle.append('circle')
      .classed('pointer', function(d) {
        if (d.type === 'person' && d.hasBio) {
          return true;
        }
        return false;
      })
      .classed('is-leader', function(d) {
        if (d.isLeader) {
          return true;
        }
      })
      .classed('is-small', function(d) {
        if (!d.isLeader) {
          let boolArray = [true, false];
          return boolArray[Math.floor(Math.random() * boolArray.length)];
        }
      })
      .attr('r', function() {
        return radius;
      })
      .attr('fill', function(d) {
        if (d.type === 'person') {
          return `url(#pattern-${d.id})`
        } else {
          return '#e63c2f';
        }
      })
      .attr('cx', 0)
      .attr('cy', 0);

    circle.each(function(d) {
      if (d.type === 'factoid') {
        d3.select(this)
          .classed('is-factoid', true)
          .append('foreignObject')
          .attr('y', -75)
          .attr('x', -60)
          .attr('width', 120)
          .attr('height', 160)
          .append('xhtml:div')
          .classed('fact-label', true)
          .append('span')
          .classed('t-white din-condensed lh-solid t-22', true)
          .attr('text-anchor', 'middle')
          .html(function(d) { return d.text; });
      }

      d.oradius = 55;

    });

    circle.append('text')
      .classed('t-red din-condensed lh-solid t-24 ttu label-text', true)
      .attr('fill', '#e63c2f')
      .attr('text-anchor', 'middle')
      .attr('y', 110)
      .classed('pointer', true)
      .text(function(d) { return d.name; });

    circle.append('text')
      .classed('t-dark-blue poppins-reg lh-solid t-12 label-text', true)
      .attr('fill', '#1d252d')
      .attr('text-anchor', 'middle')
      .attr('y', 125)
      .classed('pointer', true)
      .text(function(d) { return d.position; });

    let force = d3.forceSimulation()
      .nodes(processedNodes)
      .force('center', d3.forceCenter(width / 2, 500))
      // .force('charge', d3.forceManyBody())
      .force('collide', d3.forceCollide().radius(function(d) {
        return d.oradius + 20;
      }).strength(0.5).iterations(250))
      .force('x', d3.forceX(width / 2).strength(0.1))
      .force('y', d3.forceY(500).strength(0.1));

    d3.timer(tick);

    function dragstarted(d) {
      if (!d3.event.active) {
        force.alphaTarget(0.01).restart();
      }

      d.fx = d.x;
      d.fy = d.y;
    }

    function dragged(d) {
      d.fx = d3.event.x;
      d.fy = d3.event.y;
    }

    function dragended(d) {
      if (!d3.event.active) {
        force.alphaTarget(0.01).restart();
      }

      d.fx = null;
      d.fy = null;
    }

    function tick() {
      if (isOrganized) {
        circle
          .attr('transform', function(d) {
            let x = d.ox;
            let y = d.oy;
            return `translate(${x}, ${y})`;
          });
      } else {
        circle
          .attr('transform', function(d) {
            let x = d.x;
            let y = d.y;
            // console.log(containerLeftOffset);

            //  node
            //   .attr("cx", function(d) { return d.x = Math.max(radius, Math.min(width - radius, d.x)); })
            //   .attr("cy", function(d) { return d.y = Math.max(radius, Math.min(height - radius, d.y)); });

            // return `translate(${x}, ${y})`;
            return `translate(${Math.max((containerLeftOffset * -1) + 20, Math.min((wWidth - (120 * 2)), x))}, ${Math.max(d.oradius - 450, Math.min(height - d.oradius, y))})`;
            // return `translate(${Math.max((containerLeftOffset * -1) + 20, Math.min((wWidth - (120 * 2)), x))}, ${Math.max(radius, Math.min(height - radius, y))})`;
          });
      }
    }

    setTimeout(() => {
      $('.node').each(function(index) {
        var $this = $(this);

        setTimeout(() => {
          $this.addClass('is-loaded');
        }, index * 10);
      });
    }, 1000);

    setTimeout(() => {
      if(window.location.hash.length > 1) {
        var texts = svg.selectAll("text.t-red");
        texts.each(function(d) {
          if(d.name && d.name.replace(/ /g, "-").replace(/'/g, '').toLowerCase() == window.location.hash.substr(1)) {
            openPersonOverlay(d);
          }
        });
      }
    }, 2000);
  },
};
