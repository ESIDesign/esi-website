// import external dependencies
import 'jquery';

// import local dependencies
import Router from './util/router';
import common from './routes/Common';
import home from './routes/Home';
import about from './routes/About';
import people from './routes/People';
import jobs from './routes/Jobs';
import singleCaseStudy from './routes/CaseStudy';
import contact from './routes/Contact';
import lab from './routes/Lab';
import latest from './routes/Blog';
import singleWork from './routes/SingleWork';
import singleVertical from './routes/Vertical';
import postTypeArchiveWork from './routes/Work';
// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
const routes = {
  // All pages
  common,
  home,
  about,
  people,
  jobs,
  singleCaseStudy,
  contact,
  singleWork,
  lab,
  latest,
  singleVertical,
  postTypeArchiveWork,
};

// Load Events
document.addEventListener('DOMContentLoaded', () => new Router(routes).loadEvents());
