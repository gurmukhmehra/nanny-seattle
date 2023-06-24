import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "../views/Dashboard";
import Offer from "../views/Offer";
import Signup from "../views/Signup";
import NanyContract from "../views/NanyContract";
import NanyShareContract from "../views/NanyShareContract";
import BackgroundChecks from "../views/BackgroundChecks";
import FaqGuides from "../views/FaqGuides";
import LastMinuteGroupText from "../views/LastMinuteGroupText";
import testing from "../views/testing";
import BuyPlan from "../views/BuyPlan";
import StripePayment from "../views/StripePayment";
import PaymentCancel from "../views/PaymentCancel";
import PaymentSuccess from "../views/PaymentSuccess";
import Login from "../views/Login";
import PayrollService from "../views/PayrollService";
import PayCalculator from "../views/PayCalculator";
import SignupChooser from "../views/SignupChooser";
import VerifiedCareProviders from "../views/VerifiedCareProviders";
import SignCareProvider from "../views/SignCareProvider";
import OfferCareProviders from "../views/OfferCareProviders";
import CareProvidersJobs from "../views/CareProvidersJobs";
import SignUpAgencies from "../views/SignUpAgencies";
import AboutUs from "../views/AboutUs";
import ContactUs from "../views/ContactUs";
import RewardsOverview from "../views/RewardsOverview";
import RewardsSignup from "../views/RewardsSignup";
import RewardsLogin from "../views/RewardsLogin";
import RewardsForgotPassword from "../views/RewardsForgotPassword";
import BuyCareProviderPlan from "../views/BuyCareProviderPlan";
import BuyAgenciesPlan from "../views/BuyAgenciesPlan";
import UserDashoard from "../views/Users/UserDashboard";
import MemberSearch from "../views/MemberSearch";
import GroupDetail from "../views/Users/GroupDetail";
import UserAbout from "../views/Users/UserAbout";
import UserMembership from "../views/Users/UserMembership";
import UserFriends from "../views/Users/UserFriends";
import UserGroups from "../views/Users/UserGroups";
import Chats from "../views/Users/Chats";
import Timeline from "../views/Users/Timeline";
import UserSettings from "../views/Users/UserSettings";
import PrivateMessages from "../views/Users/PrivateMessages";
import ForgotPassword from "../views/ForgotPassword";
import TermsOfUse from "../views/TermsOfUse";
import PrivacyPolicy from "../views/PrivacyPolicy";
import FriendProfile from "../views/Users/FriendProfile";
import MemberAbout from "../views/Users/FriendPages/MemberAbout";
import MemberReviews from "../views/Users/FriendPages/MemberReviews";
import MemberFriendsList from "../views/Users/FriendPages/MemberFriendsList";
import Reviews from "../views/Users/Reviews";
import ApplyJob from "../views/ApplyJob";
import MemberMessages from "../views/Users/FriendPages/MemberMessages";
import OfferFamiliesParents from "../views/OfferFamiliesParents";
import LearningGuidesParents from "../views/LearningGuidesParents";
import LearningGuidesCareProvider from "../views/LearningGuidesCareProvider";
import SignUpFamiliesParentsConcierge from "../views/SignUpFamiliesParentsConcierge";
import Help from "../views/Help";
import BuyCareProviderFreePlan from "../views/BuyCareProviderFreePlan";
import ThankYouCareProviderFree from "../views/ThankYouCareProviderFree";
import PayRateWorksheet from "../views/PayRateWorksheet";
import RegisterNannyContract from "../views/RegisterNannyContract";
import NannyContractPlanPayment from "../views/NannyContractPlanPayment";

import MembersBio from "../views/Users/Settings/MembersBio";
import MembersBasicInfo from "../views/Users/Settings/MembersBasicInfo";
import MembersProfilePassword from "../views/Users/Settings/MembersProfilePassword";
import MembersProfileAndCoverImage from "../views/Users/Settings/MembersProfileAndCoverImage";
import MembersSocailLinks from "../views/Users/Settings/MembersSocailLinks";

import LoggedInProviderMember from "../views/Users/LoggedInProviderMember";
import LoggedInFamilyMember from "../views/Users/LoggedInFamilyMember";
import LoggedInAgencyMember from "../views/Users/LoggedInAgencyMember";
import NannyPaySurveyResults from "../views/NannyPaySurveyResults";
import NannyPayBellevueKirklandResults from "../views/NannyPayBellevueKirklandResults";
import NannyPayseattleResults from "../views/NannyPayseattleResults";

import ThankYouAgencyAnnual from "../views/ThankuPages/ThankYouAgencyAnnual";
import ThankYouAgencyMonthly from "../views/ThankuPages/ThankYouAgencyMonthly";
import ThankYouAgencyOneMonthOnly from "../views/ThankuPages/ThankYouAgencyOneMonthOnly";
import ThankYouFamilyAnnual from "../views/ThankuPages/ThankYouFamilyAnnual";
import ThankYouFamilyMonthly from "../views/ThankuPages/ThankYouFamilyMonthly";
import ThankYouFamilyOneMonthOnly from "../views/ThankuPages/ThankYouFamilyOneMonthOnly";
import ThankYouCareProviderAnnual from "../views/ThankuPages/ThankYouCareProviderAnnual";
import ThankYouConcierge from "../views/ThankYouConcierge";
import MemberNotificationList from "../views/Users/MemberNotificationList";

const routes = [ 
  {
    name: 'UserDashboard',
    path: '/UserDashboard',
    component: UserAbout
  }, 
  {
    path: "/",
    name: "Dashboard",
    component: Dashboard,
  }, 
  {
    path: "/offer",
    name: "Offer",
    component: Offer,
  }, 
  {
    path: "/sign-up-families-parents",
    name: "sign-up-families-parents",
    component: Signup,
  },
  {
    path: "/offer-families-parents",
    name: "offer-families-parents",
    component: OfferFamiliesParents,
  }, 
  {
    path: "/nanny-contract",
    name: "NanyContract",
    component: NanyContract,
  }, 
  {
    path: "/nanny-share-contract",
    name: "NanyShareContract",
    component: NanyShareContract,
  }, 
  {
    path: "/background-checks",
    name: "BackgroundChecks",
    component: BackgroundChecks,
  }, 
  {
    path: "/last-minute-group-text",
    name: "LastMinuteGroupText",
    component: LastMinuteGroupText,
  }, 
  {
    path: "/faq-guides",
    name: "FaqGuides",
    component: FaqGuides,
  },
  {
    path: "/testing",
    name: "Testing Page",
    component: testing,
  },  
  {
      path: '/register/:slug',
      name: 'register',
      component: BuyPlan
  },  
  // {
  //   path: '/register',
  //   name: 'register'
  // },
  {
    path: '/login',
    name: 'login',
    component: Login,
    props:true    
  },
  {
    path: '/stripepayment',
    name: 'stripepayment',
    component: StripePayment,
    props:true    
  },
  {
    path: '/cancel',
    name: 'cancel',
    component: PaymentCancel,
    props:true    
  },
  {
    path: '/success',
    name: 'success',
    component: PaymentSuccess,
    props:true    
  },
  {
    path: '/thank-you-family-annual',
    name: 'ThankYouFamilyAnnual',
    component: ThankYouFamilyAnnual,
    props:true    
  },
  {
    path: '/thank-you-family-monthly',
    name: 'ThankYouFamilyMonthly',
    component: ThankYouFamilyMonthly,
    props:true    
  },
  {
    path: '/thank-you-family-one-month-only',
    name: 'ThankYouFamilyOneMonthOnly',
    component: ThankYouFamilyOneMonthOnly,
    props:true    
  },
  {
    path: '/thank-you-care-providers-annual',
    name: 'ThankYouCareProviderAnnual',
    component: ThankYouCareProviderAnnual,
    props:true    
  },
  {
    path: '/thank-you-agency-annual',
    name: 'ThankYouAgencyAnnual',
    component: ThankYouAgencyAnnual,
    props:true    
  },
  {
    path: '/thank-you-agency-monthly',
    name: 'ThankYouAgencyMonthly',
    component: ThankYouAgencyMonthly,
    props:true    
  },
  {
    path: '/thank-you-agency-one-month-only',
    name: 'ThankYouAgencyOneMonthOnly',
    component: ThankYouAgencyOneMonthOnly,
    props:true    
  },
  {
    path: '/payroll-service',
    name: 'payroll-service',
    component: PayrollService,
    props:true    
  },
  {
    path: '/pay-calculator',
    name: 'pay-calculator',
    component: PayCalculator,
    props:true    
  },
  {
    path: '/sign-up-chooser',
    name: 'sign-up-chooser',
    component: SignupChooser,
    props:true    
  },
  {
    path: '/verified-care-providers',
    name: 'verified-care-providers',
    component: VerifiedCareProviders,
    props:true    
  },
  {
    path: '/sign-care-provider',
    name: 'sign-care-provider',
    component: SignCareProvider,
    props:true    
  },
  {
    path: '/buy-care-provider-plan/:slug',
    name: 'buy-care-provider-plan',
    component: BuyCareProviderPlan,      
    props:route =>({
      planID : route.params.slug
    })
  },
  {
    path: '/:slug',
    name: 'buy-care-provider-free-plan-questions',
    component: BuyCareProviderFreePlan,      
    props:route =>({
      planID : route.params.slug
    })
  }
  ,
  {
    path: '/offer-care-providers',
    name: 'offer-care-providers',
    component: OfferCareProviders,
    props:true
  },
  {
    path: '/care-providers-jobs',
    name: 'care-providers-jobs',
    component: CareProvidersJobs,
    props:true
  },
  {
    path: '/sign-up-agencies',
    name: 'sign-up-agencies',
    component: SignUpAgencies,
    props:true
  },
  {
    path: '/buy-agencies-plan/:slug',
    name: 'buy-agencies-plan',
    component: BuyAgenciesPlan,      
    props:route =>({
      planID : route.params.slug
    })
  },
  {
    path: '/about-us',
    name: 'about-us',
    component: AboutUs,
    props:true
  },
  {
    path: '/contact-us',
    name: 'contact-us',
    component: ContactUs,
    props:true
  },
  {
    path: '/rewards-overview',
    name: 'rewards-overview',
    component: RewardsOverview,
    props:true
  },
  {
    path: '/rewards-signup',
    name: 'rewards-signup',
    component: RewardsSignup,
    props:true
  },
  {
    path: '/rewards-login',
    name: 'rewards-login',
    component: RewardsLogin,
    props:true
  },
  {
    path: '/rewards-forgot-password',
    name: 'rewards-forgot-password',
    component: RewardsForgotPassword,
    props:true
  },
  {
    path: '/member-search',
    name: 'MemberSearch',
    component: MemberSearch,
    props:true    
  },
  {
    path: '/group/:groupslug',
    name: 'group',
    props:true,
    component: GroupDetail,      
    props:route =>({
      groupID : route.params.groupslug
    })
  },
  {
    path: '/member-about',
    name: 'MemberAbout',
    component: UserAbout,
    props:true    
  },
  {
    path: '/membership',
    name: 'UserMembership',
    component: UserMembership,
    props:true    
  },
  {
    path: '/member-friends',
    name: 'UserFriends',
    component: UserFriends,
    props:true    
  },
  {
    path: '/groups',
    name: 'UserGroups',
    component: UserGroups,
    props:true    
  },
  {
    path: '/chats',
    name: 'Chats',
    component: Chats,
    props:true    
  },
  {
    path: '/private-messages',
    name: 'private-messages',
    component: PrivateMessages,
    props:true    
  },
  {
    path: '/timeline',
    name: 'Timeline',
    component: Timeline,
    props:true    
  },
  {
    path: '/profile-settings',
    name: 'UserSettings',
    component: UserSettings,
    props:true    
  },
  {
    path: '/forgot-password/:username',
    name: 'ForgotPassword',
    component: ForgotPassword,
    props:true    
  },
  {
    path: "/terms-of-use",
    name: "TermsOfUse",
    component: TermsOfUse,
  }
  ,
  {
    path: "/privacy-policy",
    name: "PrivacyPolicy",
    component: PrivacyPolicy,
  },
  {
    path: '/GetMemberAbout/:username',
    name: 'GetMemberAbout',
    component: FriendProfile,
    props:true,      
    props:route =>({
      username : route.params.username
    })
  },
  {
    path: '/members-about/:username',
    name: 'members-about',
    component: MemberAbout,
    props:true,      
    props:route =>({
      username : route.params.username
    })
  },
  {
    path: '/members-frineds-list/:username',
    name: 'members-frineds-list',
    component: MemberFriendsList, 
    props:true,     
    props:route =>({
      username : route.params.username
    })
  },
  {
    path: '/members-reviews/:username',
    name: 'members-reviews',
    component: MemberReviews, 
    props:true,     
    props:route =>({
      username : route.params.username
    })
  },
  {
    path: "/reviews",
    name: "Reviews",
    component: Reviews,
  },  
  {
    path: '/apply-job',
    name: 'apply-job',
    component: ApplyJob, 
    props:true,
    props:route =>({
      job_id : route.params.job_id
    })
  },
  {
    path: '/members-messages/:username',
    name: 'members-messages',
    component: MemberMessages, 
    props:true,     
    props:route =>({
      username : route.params.username
    })
  },
  {
    path: '/learning-guides-provider-how-it-works',
    name: 'learning-guides-provider-how-it-works',
    component: LearningGuidesCareProvider, 
    props:true
  },
  {
    path: '/learning-guides-parents',
    name: 'learning-guides-parents',
    component: LearningGuidesParents, 
    props:true
  },
  {
    path: '/sign-up-families-parents-concierge',
    name: 'sign-up-families-parents-concierge',
    component: SignUpFamiliesParentsConcierge, 
    props:true
  },
  {
    path: '/thank-you-concierge',
    name: 'thank-you-concierge',
    component: ThankYouConcierge, 
    props:true
  },
  {

    path: '/help',
    name: 'help',
    component: Help, 
    props:true
  },
  {
    path: '/thank-you-care-providers-free',
    name: 'thank-you-care-providers-free',
    component: ThankYouCareProviderFree
  },
  {
    path: '/pay-rate-worksheet',
    name: 'pay-rate-worksheet',
    component: PayRateWorksheet, 
    props:true
  },
  // {
  //   path: '/register/:slug',
  //   name: 'register',
  //   component: RegisterNannyContract,      
  //   props:route =>({
  //     planID : route.params.slug
  //   })
  // },
  // {
  //   path: '/nanny-contract-payment',
  //   name: 'nanny-contract-payment',
  //   component: NannyContractPlanPayment,
  //   props:true    
  // }, 
  {
    path: '/member-bio',
    name: 'member-bio',
    component: MembersBio, 
    props:true
  }, 
  {
    path: '/basic-info',
    name: 'basic-info',
    component: MembersBasicInfo, 
    props:true
  }, 
  {
    path: '/profile-password',
    name: 'profile-password',
    component: MembersProfilePassword, 
    props:true
  }, 
  {
    path: '/profile-cover-image',
    name: 'profile-cover-image',
    component: MembersProfileAndCoverImage, 
    props:true
  }, 
  {
    path: '/profile-socail-link',
    name: 'profile-socail-link',
    component: MembersSocailLinks, 
    props:true
  },
  {
    name: 'logged-in-provider',
    path: '/logged-in-provider',
    component: LoggedInProviderMember
  },
  {
    name: 'logged-in-family',
    path: '/logged-in-family',
    component: LoggedInFamilyMember
  },
  {
    name: 'logged-in-agency',
    path: '/logged-in-agency',
    component: LoggedInAgencyMember
  },
  {
    path: "/order-background-check",
    name: "order-background-check",
    component: BackgroundChecks,
  },
  {
    path: "/nanny-pay-survey-2023-results",
    name: "nanny-pay-survey-2023-results",
    component: NannyPaySurveyResults,
  },
  {
    path: "/nanny-pay-bellevue-kirkland-survey-results-2023",
    name: "nanny-pay-bellevue-kirkland-survey-results-2023",
    component: NannyPayBellevueKirklandResults,
  },
  {
    path: "/nanny-pay-seattle-survey-results-2023",
    name: "nanny-pay-seattle-survey-results-2023",
    component: NannyPayseattleResults,
  },
  {
    path: "/notification",
    name: "notification",
    component: MemberNotificationList,
  }
]; 

const router = createRouter({ 
  // scrollBehavior(to, from, savedPosition) {
  //   return new Promise((resolve, reject) => {
  //     setTimeout(() => {
  //       resolve({ left: 0, top: 0 })
  //     }, 500)
  //   })
  // }, 
  history: createWebHistory(),
  routes, 
});

export default router;
