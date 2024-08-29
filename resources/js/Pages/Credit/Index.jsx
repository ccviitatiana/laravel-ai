import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import CreditPricingCards from "@/Components/CreditPricingCards";

export default function Index({ auth, packages, features, success, error }) {
    const availableCredits = auth.user.available_credits;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Your Credits
                </h2>
            }
        >
            <Head title="Your Credits" />
            <div className="py-8">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {success ? (
                        <div className="rounded-2xl pl-7 font-medium bg-primary-600 text-gray-100 p-3 mb-4 bg-">
                            <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <div className="text-4xl items-center text-center">{success}</div>
                                <div className="text-9xl">☆⌒(ゝ。∂)</div>
                            </div>
                        </div>
                    ) : null}
                    {error ? (
                        <div className="rounded-2xl pl-7 font-medium bg-rose-600 text-gray-100 p-3 mb-4">
                            {error}
                        </div>
                    ) : null}
                    <CreditPricingCards
                        packages={packages.data}
                        features={features.data}
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
